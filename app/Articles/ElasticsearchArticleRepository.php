<?php
/**
 * Created by PhpStorm.
 * User: FXLABO
 * Date: 13/05/2017
 * Time: 01:21
 */

namespace App\Articles;


use App\Article;
use Illuminate\Database\Eloquent\Collection;
use Elasticsearch\Client;

class ElasticsearchArticleRepository implements ArticleRepository
{

    private $elasticClient;

    public function __construct(Client $elasticClient)
    {
        $this->elasticClient = $elasticClient;
    }

    public function search(string $query = ""): Collection
    {
        $items = $this->searchOnElasticsearch($query);

        return $this->buildCollection($items);
    }

    public function searchOnElasticsearch(string $query): array
    {
        $instance = new Article();

        $items = $this->elasticClient->search([
            'index' => $instance->getSearchIndex(),
            'type' => $instance->getSearchType(),
            'body' => [
                'query' => [
                    'multi_match' => [
                        'fields' => ['title', 'body', 'tags'],
                        'query' => $query
                    ]
                ],
                'highlight' => []
            ]
        ]);

        return $items;
    }

    private function buildCollection(array $items): Collection
    {
        /**
         * The data comes in a structure like this:
         *
         * [
         *      'hits' => [
         *          'hits' => [
         *              [ '_source' => 1 ],
         *              [ '_source' => 2 ],
         *          ]
         *      ]
         * ]
         *
         * And we only care about the _source of the documents.
         */

        $hits = array_pluck($items['hits']['hits'], '_source') ?: [];

        $sources = array_map(function ($source) {
            $source['tags'] = json_encode($source['tags']);

            return $source;
        }, $hits);

        return Article::hydrate($sources);
    }
}
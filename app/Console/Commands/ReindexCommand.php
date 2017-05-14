<?php

namespace App\Console\Commands;

use App\Article;
use Illuminate\Console\Command;
use Elasticsearch\Client;

class ReindexCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'elasticsearch:index';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Index all articles to elasticsearch.';
    private $elasticClient;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Client $elasticClient)
    {
        parent::__construct();

        $this->elasticClient = $elasticClient;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Indexing all articles. Might take a while...');
        foreach (Article::cursor() as $model) {
            $this->elasticClient->index([
                'index' => $model->getSearchIndex(),
                'type' => $model->getSearchType(),
                'id' => $model->id,
                'body' => $model->toSearchArray(),
            ]);

            $this->output->write('.');
        }

        $this->info("\nModel indexed.");
    }
}

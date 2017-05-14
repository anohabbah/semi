<?php
/**
 * Created by PhpStorm.
 * User: FXLABO
 * Date: 13/05/2017
 * Time: 02:04
 */

namespace App\Search;


trait Searchable
{
    public static function bootSearchable()
    {
        if (config('services.search.enabled')) {
            static::observe(ElasticsearchObserver::class);
        }
    }

    public function getSearchIndex()
    {
        if (property_exists($this, 'searchIndex')) {
            return $this->searchIndex;
        }

        return $this->getTable();
    }

    public function getSearchType()
    {
        if (property_exists($this, 'searchType')) {
            return $this->searchType;
        }

        return $this->getTable();
    }

    public function toSearchArray()
    {
        // By having a custom method that transforms the model
        // to a searchable array allows us to customize the
        // data that's going to be searchable per model.
        return $this->toArray();
    }
}
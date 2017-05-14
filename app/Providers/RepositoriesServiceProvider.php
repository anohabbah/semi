<?php

namespace App\Providers;

use App\Articles\ArticleRepository;
use App\Articles\ElasticsearchArticleRepository;
use App\Articles\EloquentArticleRepository;
use Illuminate\Support\ServiceProvider;
use Elasticsearch\Client;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ArticleRepository::class, function ($app) {
            if (! config('services.search.enabled')) {
                return new EloquentArticleRepository();
            }

            return new ElasticsearchArticleRepository(
                $this->app->make(Client::class)
            );
        });
    }
}

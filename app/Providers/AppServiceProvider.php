<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\ArticleRepository;
use App\Service\ArticleService;
use App\Service\FeedService;
use App\Entity\Article;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ArticleRepository::class, function ($app) {
            return new ArticleRepository(
                $app['em']->getRepository(Article::class)
            );
        });
        $this->app->singleton(ArticleService::class, function ($app) {
            return new ArticleService($app[ArticleRepository::class]);
        });
        $this->app->singleton(FeedService::class, function ($app) {
            return new FeedService($app['Feeds']);
        });
    }
}

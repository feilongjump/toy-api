<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\Content;
use App\Models\Todo;
use App\Observers\ArticleObserver;
use App\Observers\ContentObserver;
use App\Observers\TodoObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Resources\Json\JsonResource;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        JsonResource::withoutWrapping();

        Article::observe(ArticleObserver::class);
        Content::observe(ContentObserver::class);
        Todo::observe(TodoObserver::class);
    }
}

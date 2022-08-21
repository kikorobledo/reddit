<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\PostVote;
use App\Models\Community;
use App\Observers\PostObserver;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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

        View::share('newest_communities', Post::with('community')->latest()->take(5)->get());

        View::share('newest_posts', Community::withCount('posts')->latest()->take(5)->get());

        PostVote::observe(PostObserver::class);

    }
}

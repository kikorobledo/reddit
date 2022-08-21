<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('post-edit', function(User $user, Post $post){

            return $post->user_id == $user->id;

        });

        Gate::define('post-delete', function(User $user, Post $post){

            return $user->is_admin || in_array($user->id, [$post->user_id, $post->community->user->id]);

        });
    }
}

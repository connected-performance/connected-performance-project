<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;


use App\Policies\UserPolicy;
use App\Repositories\Contracts\AccountRepository;
use Illuminate\Contracts\Container\BindingResolutionException;



class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
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

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function boot()
    {
        $this->registerPolicies();
        $accountRepository = $this->app->make(AccountRepository::class);
        foreach (config('permissions') as $key => $permissions) {
            Gate::define($key, function (User $user) use ($accountRepository, $key) {
                return $accountRepository->hasPermission($user, $key);
            });
        }

        // foreach (config('customer-permissions') as $key => $permissions) {
        //     Gate::define($key, function (User $user) use ($accountRepository, $key) {
        //         return $accountRepository->hasPermission($user, $key);
        //     });
        // }
    }
}

<?php

namespace App\Providers;

use App\Models\Menu;
use App\Models\SousMenu;
use App\Models\Role;
use App\Models\Permission;
use App\Policies\RolePolicy;
use App\Policies\PermissionPolicy;
use App\Policies\MenuPolicy;
use App\Policies\SubMenuPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Role::class => RolePolicy::class,
        Permission::class => PermissionPolicy::class,
        Menu::class => MenuPolicy::class,
        SousMenu::class => SubMenuPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /*if (! $this->app->routesAreCached()) {
            Passport::routes();
        }*/
    }
}

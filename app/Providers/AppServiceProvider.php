<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Models\Order;
use App\Models\Client;
use App\Models\Provider;
use App\Models\Study;
use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->share('usersCount', User::count());
        view()->share('ordersCount', User::whereDate('created_at',\Carbon\Carbon::today())->count());
        view()->share('clientsCount', Client::count());
        view()->share('providersCount', Provider::count());
        view()->share('estudios', Study::get());
    }
}

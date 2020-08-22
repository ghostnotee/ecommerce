<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
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
        /*$endTime = now()->addMinutes(10);

        $statistics = Cache::remember('statistics', $endTime, function () {
            return ['pendingOrder' => Order::where('status', 'Siparişiniz alındı')->count()];
        });

        View::share('statistics', $statistics);*/

        View::composer(['admin.*'], function ($view) {
            $endTime = now()->addMinutes(10);
            $statistics = Cache::remember('statistics', $endTime, function () {
                return [
                    'pendingOrder' => Order::where('status', 'Siparişiniz alındı')->count(),
                    'complatedOrder' => Order::where('status', 'Sipariş tamamlandı')->count(),
                    'totalProduct' => Product::count(),
                    'totalCategory' => Category::count(),
                    'totalUser' => User::count()
                ];
            });
            $view->with('statistics', $statistics);
        });
    }
}

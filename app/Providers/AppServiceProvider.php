<?php

namespace App\Providers;

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\RoleMiddleware;
use App\View\Components\GuestLayout;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Cart;

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
     * @param Router $router
     * @return void
     */
    public function boot(Router $router): void
    {
        // Register the role middleware here in provider
        $router->aliasMiddleware('role', RoleMiddleware::class);
        //guest layout

        Blade::component('guest-layout', GuestLayout::class);

        View::composer('*', function ($view) {
            $userId = auth()->id();
            $cart = Cart::with('items.product')->where('user_id', $userId)->first();
            $view->with('cart', $cart);
        });


    }
}

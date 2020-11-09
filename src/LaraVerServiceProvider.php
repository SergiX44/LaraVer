<?php

namespace SergiX44\LaraVer;

use Illuminate\Routing\Route;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use SergiX44\LaraVer\Mixins\RouteMixin;
use SergiX44\LaraVer\Mixins\RouterMixin;

class LaraVerServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     * @throws \ReflectionException
     */
    public function boot(): void
    {
        Route::mixin(new RouteMixin);
        Router::mixin(new RouterMixin);
    }
}

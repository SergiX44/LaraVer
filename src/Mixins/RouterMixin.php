<?php


namespace SergiX44\LaraVer\Mixins;

use Illuminate\Routing\Router;
use SergiX44\LaraVer\LaraVer;
use SergiX44\LaraVer\Support\Helpers;

/**
 * Class RouterMixin
 * @package App
 * @mixin Router
 */
class RouterMixin
{
    public function groupVersioned()
    {
        return function (array $attributes, $routes) {
            $attributes[RouteMixin::VERSION] = LaraVer::parseVersion($this->getLastGroupPrefix());
            $this->group($attributes, $routes);
        };
    }

}
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
    /**
     * @return \Closure
     */
    public function groupVersioned()
    {
        return function (array $attributes, $routes) {
            // add the attribute on the route stack
            $attributes[RouteMixin::VERSION] = LaraVer::parseVersion($this->getLastGroupPrefix());
            // than groups everything
            $this->group($attributes, $routes);
        };
    }

}
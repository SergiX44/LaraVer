<?php


namespace SergiX44\LaraVer\Mixins;

use Illuminate\Routing\Route;
use SergiX44\LaraVer\LaraVer;

/**
 * @mixin Route
 */
class RouteMixin
{
    const VERSION = 'endpointVersion';

    public function versioned()
    {
        return function () {
            // set a version for the endpoint as default parameter
            $this->action[RouteMixin::VERSION] = LaraVer::parseVersion($this->uri());

            return $this;
        };
    }

    /**
     * @return int|\Closure
     */
    public function getVersion()
    {
        return function () {
            return $this->action[RouteMixin::VERSION] ?? null;
        };
    }
}
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
            // set the route action attribute
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

    /**
     * @return bool|\Closure
     */
    public function isVersioned() {
        return function () {
          return $this->getVersion() !== null;
        };
    }

    /**
     * @return bool|\Closure
     */
    public function isVersion() {
        return function (int $version) {
          return $this->getVersion() === $version;
        };
    }
}
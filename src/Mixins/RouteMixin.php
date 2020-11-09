<?php


namespace SergiX44\LaraVer\Mixins;

use Illuminate\Routing\Route;
use SergiX44\LaraVer\Support\Helpers;

/**
 * @mixin Route
 */
class RouteMixin
{
    const VERSION = 'endpointVersion';

    public function version()
    {
        return function (?int $version = 1) {
            if ($this->getVersion() !== null) { // if we are in a versioned group
                $this->setUri(Helpers::replaceVersion($this->getVersion(), $version, $this->uri));
            } else { // if there is nothing versioned above us
                $this->setUri(str_replace($this->getPrefix(), '', $this->uri));
                $this->prefix("{$this->getPrefix()}/v{$version}");
            }

            // set a version for the endpoint as default parameter
            $this->action[RouteMixin::VERSION] = $version;

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
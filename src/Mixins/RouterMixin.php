<?php


namespace SergiX44\LaraVer\Mixins;

use Illuminate\Routing\Router;
use SergiX44\LaraVer\Support\Helpers;

/**
 * Class RouterMixin
 * @package App
 * @mixin Router
 */
class RouterMixin
{
    public $groupStack = [];

    public function versioned()
    {
        return function (?int $version = 1) {
            return (new VersionedRouteRegistrar($this))->versioned($version);
        };
    }

    public function versionedGroup()
    {
        return function (array $attributes, $routes, ?int $version = 1) {
            if (!isset($attributes[RouteMixin::VERSION])) { // allow declaration in the route attributes
                $attributes[RouteMixin::VERSION] = $version;
            } else {
                $version = $attributes[RouteMixin::VERSION]; // if declare as attribute always win
            }

            $oldPrefix = $this->getLastGroupPrefix();
            if (isset(end($this->groupStack)[RouteMixin::VERSION])) { // if we are in an already versioned group
                $lastGroup = array_pop($this->groupStack);
                $lastGroup['prefix'] = Helpers::replaceVersion($lastGroup[RouteMixin::VERSION], $version, $oldPrefix);
                $this->groupStack[] = $lastGroup;
            } elseif (isset($attributes['prefix'])) { // if we are the first versioned group, and we have also a prefix
                $attributes['prefix'] = "v{$version}/{$attributes['prefix']}";
            } else { // the first prefix is the version
                $attributes['prefix'] = "v{$version}";
            }

            $this->group($attributes, $routes);

            // restore the last group prefix
            $lastGroup = array_pop($this->groupStack);
            $lastGroup['prefix'] = $oldPrefix;
            $this->groupStack[] = $lastGroup;
        };
    }

}
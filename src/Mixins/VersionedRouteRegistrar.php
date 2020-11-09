<?php


namespace SergiX44\LaraVer\Mixins;


use Illuminate\Routing\Route;
use Illuminate\Routing\Router;
use Illuminate\Routing\RouteRegistrar;

class VersionedRouteRegistrar extends RouteRegistrar
{
    public function __construct(Router $router)
    {
        parent::__construct($router);
        $this->allowedAttributes[] = RouteMixin::VERSION;
    }

    public function versioned(?int $version = 1)
    {
        $this->attribute(RouteMixin::VERSION, $version);
        $this->prefix("v{$version}");

        return $this;
    }

    public function prefix(string $prefix)
    {
        $version = $this->attributes[RouteMixin::VERSION] ?? null;
        if ($version !== null) {
            $prefix = "{$prefix}/v{$version}";
        }

        parent::prefix($prefix);

        return $this;
    }

}
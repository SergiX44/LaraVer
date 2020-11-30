<?php


namespace SergiX44\LaraVer\Concerns;


use Illuminate\Container\Container;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\ConditionallyLoadsAttributes;
use JsonSerializable;
use SergiX44\LaraVer\Exceptions\VersionedMethodNotFound;

/**
 * Trait VersionableResource
 * @package SergiX44\LaraVer\Concerns
 */
trait VersionableResource
{
    use ConditionallyLoadsAttributes;

    /**
     * Resolve the resource to an array.
     *
     * @param  \Illuminate\Http\Request|null  $request
     * @return array
     * @throws VersionedMethodNotFound
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function resolve($request = null)
    {
        $request = $request ?: Container::getInstance()->make('request');

        $prefix = ucfirst(config('laraver.version_prefix', 'v'));

        $method = "toArray{$prefix}{$request->route()->getVersion()}";

        if (!$request->route()->isVersioned() || $request->route()->isVersion(1)) {
            $method = 'toArray';
        }

        if ($request->route()->isVersioned() && !method_exists($this, $method)) {
            throw new VersionedMethodNotFound($method);
        }

        $data = $this->$method($request);

        if ($data instanceof Arrayable) {
            $data = $data->toArray();
        } elseif ($data instanceof JsonSerializable) {
            $data = $data->jsonSerialize();
        }

        return $this->filter((array) $data);
    }

}
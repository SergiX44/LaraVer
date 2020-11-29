<?php


namespace SergiX44\LaraVer;


class LaraVer
{
    /**
     * Extract the version from an uri
     * @param  string  $uri
     * @return int|null
     */
    public static function parseVersion(string $uri)
    {
        $prefix = config('laraver.version_prefix', 'v');

        preg_match("/\/{$prefix}(?<version>[0-9]+)\//", $uri, $matched);

        if (isset($matched['version'])) {
            return (int) $matched['version'];
        }
        return null;
    }
}
<?php


namespace SergiX44\LaraVer\Support;


class Helpers
{
    /**
     * @param  int  $old
     * @param  int  $new
     * @param  string  $subject
     * @return string|string[]
     */
    public static function replaceVersion(int $old, int $new, string $subject)
    {
        return str_replace("v{$old}", "v{$new}", $subject);
    }

}
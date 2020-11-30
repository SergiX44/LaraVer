<?php


namespace SergiX44\LaraVer\Exceptions;


use Exception;
use Throwable;

class VersionedMethodNotFound extends Exception
{

    /**
     * VersionedMethodNotFound constructor.
     * @param $method
     * @param  int  $code
     * @param  Throwable|null  $previous
     */
    public function __construct($method, $code = 404, Throwable $previous = null)
    {
        parent::__construct("Versioned method '{$method}' not found", $code, $previous);
    }
}
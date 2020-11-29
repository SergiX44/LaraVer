<?php


namespace SergiX44\LaraVer\Exceptions;


use Exception;
use Throwable;

class VersionedMethodNotFound extends Exception
{

    public function __construct($method, $code = 404, Throwable $previous = null)
    {
        parent::__construct("Versioned method '{$method}' not found", $code, $previous);
    }
}
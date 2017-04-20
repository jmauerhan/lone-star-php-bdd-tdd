<?php

namespace Chirper\JsonApi;

use Throwable;

class InvalidJsonException extends \Exception
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}
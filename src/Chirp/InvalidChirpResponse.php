<?php

namespace Chirper\Chirp;

use Chirper\Http\Response;

class InvalidChirpResponse extends Response
{
    public function __construct(string $reason)
    {
        parent::__construct(Response::BAD_REQUEST, [], $reason);
    }
}
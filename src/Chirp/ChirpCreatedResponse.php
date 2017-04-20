<?php

namespace Chirper\Chirp;

use Chirper\Http\Response;

class ChirpCreatedResponse extends Response
{
    public function __construct()
    {
        parent::__construct(Response::CREATED);
    }
}
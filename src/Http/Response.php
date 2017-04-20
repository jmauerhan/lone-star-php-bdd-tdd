<?php

namespace Chirper\Http;

class Response extends \GuzzleHttp\Psr7\Response
{

    const CREATED = 201;
    const BAD_REQUEST = 400;
    const INTERNAL_SERVER_ERROR = 500;
}
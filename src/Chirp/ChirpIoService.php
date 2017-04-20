<?php

namespace Chirper\Chirp;

use Chirper\Http\Request;
use Chirper\Http\Response;

class ChirpIoService
{
    /** @var JsonChirpTransformer */
    private $jsonChirpTransformer;
    /** @var ChirpPersistenceDriver */
    private $persistenceDriver;

    public function __construct(JsonChirpTransformer $jsonChirpTransformer, ChirpPersistenceDriver $persistenceDriver)
    {
        $this->jsonChirpTransformer = $jsonChirpTransformer;
        $this->persistenceDriver    = $persistenceDriver;

    }

    public function create(Request $request): Response
    {
        return new Response(Response::CREATED);
    }

}
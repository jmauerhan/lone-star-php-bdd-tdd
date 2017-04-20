<?php

namespace Chirper\Chirp;

use Chirper\Http\InternalServerErrorResponse;
use Chirper\Http\Request;
use Chirper\Http\Response;
use Chirper\JsonApi\InvalidJsonException;

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
        $json = $request->getBody()->getContents();
        try {
            $chirp = $this->jsonChirpTransformer->toChirp($json);
            $this->persistenceDriver->create($chirp);
        } catch (InvalidJsonException $invalidJsonException) {
            return new InvalidChirpResponse('Json was invalid: ' . $invalidJsonException->getMessage());
        } catch (PersistenceDriverException $persistenceDriverException) {
            return new InternalServerErrorResponse();
        }

        return new ChirpCreatedResponse();
    }

}
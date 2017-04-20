<?php

namespace Test\Unit;

use Chirper\Chirp\ChirpIoService;
use Chirper\Chirp\ChirpPersistenceDriver;
use Chirper\Chirp\JsonChirpTransformer;
use Chirper\Http\Request;
use PHPUnit\Framework\TestCase;

class ChirpIoServiceTest extends TestCase
{
    public function testCreateSendsJsonToTransformer()
    {
        $json        = "{}";
        $transformer = $this->createMock(JsonChirpTransformer::class);
        $transformer->expects($this->once())
                    ->method('toChirp')
                    ->with($json);

        $persistenceDriver = $this->createMock(ChirpPersistenceDriver::class);

        $service = new ChirpIoService($transformer, $persistenceDriver);

        $request = new Request('POST', 'chirp', [], $json);

        $service->create($request);
    }

//    public function testCreateReturnsInvalidChirpResponseWhenTransformerThrowsException()
//    {
//    }
//
//    public function testCreateSendsChirpToDatabaseDriver()
//    {
//    }
//
//    public function testCreateReturnsInternalErrorResponseWhenDatabaseDriverThrowsException()
//    {
//    }
//
//    public function testCreateReturnsChirpCreatedResponse()
//    {
//    }

}

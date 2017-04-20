<?php

namespace Test\Unit;

use Chirper\Chirp\ChirpIoService;
use Chirper\Chirp\ChirpPersistenceDriver;
use Chirper\Chirp\InvalidChirpResponse;
use Chirper\Chirp\JsonChirpTransformer;
use Chirper\Http\Request;
use Chirper\JsonApi\InvalidJsonException;
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

    public function testCreateReturnsInvalidChirpResponseWhenTransformerThrowsException()
    {
        $transformer = $this->createMock(JsonChirpTransformer::class);
        $transformer->method('toChirp')
                    ->willThrowException(new InvalidJsonException('{'));

        $expectedResponse = new InvalidChirpResponse('Json was invalid');

        $persistenceDriver = $this->createMock(ChirpPersistenceDriver::class);
        $service           = new ChirpIoService($transformer, $persistenceDriver);
        $request           = new Request('POST', 'chirp');
        $response          = $service->create($request);

        $this->assertEquals($expectedResponse, $response);
    }
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

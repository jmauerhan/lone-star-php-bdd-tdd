<?php

namespace Test\Unit;

use Chirper\Chirp\Chirp;
use Chirper\Chirp\ChirpIoService;
use Chirper\Chirp\ChirpPersistenceDriver;
use Chirper\Chirp\InvalidChirpResponse;
use Chirper\Chirp\JsonChirpTransformer;
use Chirper\Chirp\PersistenceDriverException;
use Chirper\Http\InternalServerErrorResponse;
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
        $exception   = new InvalidJsonException('{');
        $transformer = $this->createMock(JsonChirpTransformer::class);
        $transformer->method('toChirp')
                    ->willThrowException($exception);

        $persistenceDriver = $this->createMock(ChirpPersistenceDriver::class);
        $service           = new ChirpIoService($transformer, $persistenceDriver);
        $request           = new Request('POST', 'chirp');
        $response          = $service->create($request);

        $message = 'Json was invalid: ' . $exception->getMessage();
        $this->assertInstanceOf(InvalidChirpResponse::class, $response);
        $this->assertEquals($message, $response->getBody()->getContents());
    }

    public function testCreateSendsChirpToDatabaseDriver()
    {
        $chirp       = new Chirp();
        $transformer = $this->createMock(JsonChirpTransformer::class);
        $transformer->method('toChirp')
                    ->willReturn($chirp);

        $persistenceDriver = $this->createMock(ChirpPersistenceDriver::class);
        $persistenceDriver->expects($this->once())
                          ->method('create')
                          ->with($chirp);

        $service = new ChirpIoService($transformer, $persistenceDriver);
        $request = new Request('POST', 'chirp');
        $service->create($request);
    }

    public function testCreateReturnsInternalErrorResponseWhenDatabaseDriverThrowsException()
    {
        $exception   = new PersistenceDriverException();
        $transformer = $this->createMock(JsonChirpTransformer::class);

        $persistenceDriver = $this->createMock(ChirpPersistenceDriver::class);
        $persistenceDriver->method('create')
                          ->willThrowException($exception);

        $service  = new ChirpIoService($transformer, $persistenceDriver);
        $request  = new Request('POST', 'chirp');
        $response = $service->create($request);

        $this->assertInstanceOf(InternalServerErrorResponse::class, $response);
    }
//
//    public function testCreateReturnsChirpCreatedResponse()
//    {
//    }

}

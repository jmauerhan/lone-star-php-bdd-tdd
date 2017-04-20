<?php

namespace Test\Unit;

use Chirper\Chirp\ChirpIoService;
use PHPUnit\Framework\TestCase;

class ChirpIoServiceTest extends TestCase
{
    public function testCreateSendsJsonToTransformer(){

    }

    public function testCreateReturnsInvalidChirpResponseWhenTransformerThrowsException(){}

    public function testCreateSendsChirpToDatabaseDriver(){}

    public function testCreateReturnsInternalErrorResponseWhenDatabaseDriverThrowsException(){}

    public function testCreateReturnsChirpCreatedResponse(){}

}

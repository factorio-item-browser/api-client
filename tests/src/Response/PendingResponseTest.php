<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Response;

use BluePsyduck\MultiCurl\Entity\Request;
use FactorioItemBrowser\Api\Client\Client\Client;
use FactorioItemBrowser\Api\Client\Client\Options;
use FactorioItemBrowser\Api\Client\Exception\BadRequestException;
use FactorioItemBrowser\Api\Client\Exception\UnauthorizedException;
use FactorioItemBrowser\Api\Client\Response\PendingResponse;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the pending response class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass FactorioItemBrowser\Api\Client\Response\PendingResponse
 */
class PendingResponseTest extends TestCase
{
    /**
     * Tests fetching the response.
     * @covers ::__construct
     * @covers ::fetchResponse
     */
    public function testFetchResponse()
    {
        $clientRequest = new Request();
        $clientRequest->setMethod('abc');
        $responseData = ['def' => 'ghi'];

        /* @var Client|MockObject $client */
        $client = $this->getMockBuilder(Client::class)
                       ->setMethods(['fetchResponse'])
                       ->setConstructorArgs([new Options()])
                       ->getMock();
        $client->expects($this->once())
               ->method('fetchResponse')
               ->with($clientRequest)
               ->willReturn($responseData);

        $pendingResponse = new PendingResponse($client, $clientRequest);
        $this->assertEquals($responseData, $pendingResponse->fetchResponse());
    }

    /**
     * Tests fetching the response catches UnauthorizedException.
     * @covers ::__construct
     * @covers ::fetchResponse
     */
    public function testFetchResponseCatchesUnauthorizedException()
    {
        $clientRequest = new Request();
        $clientRequest->setMethod('abc');
        $responseData = ['def' => 'ghi'];

        /* @var Client|MockObject $client */
        $client = $this->getMockBuilder(Client::class)
                       ->setMethods(['fetchResponse', 'requestAuthorizationToken', 'executeRequest'])
                       ->setConstructorArgs([new Options()])
                       ->getMock();
        $client->expects($this->at(0))
               ->method('fetchResponse')
               ->with($clientRequest)
               ->willThrowException(new UnauthorizedException('test', ''));
        $client->expects($this->at(1))
               ->method('requestAuthorizationToken');
        $client->expects($this->at(2))
               ->method('executeRequest')
               ->with($this->isInstanceOf(Request::class));
        $client->expects($this->at(3))
               ->method('fetchResponse')
               ->with($this->isInstanceOf(Request::class))
               ->willReturn($responseData);

        $pendingResponse = new PendingResponse($client, $clientRequest);
        $this->assertEquals($responseData, $pendingResponse->fetchResponse());
    }

    /**
     * Tests fetching the response throws other exceptions.
     * @covers ::__construct
     * @covers ::fetchResponse
     */
    public function testFetchResponseThrowsExceptions()
    {
        $clientRequest = new Request();
        $clientRequest->setMethod('abc');
        $responseData = ['def' => 'ghi'];

        /* @var Client|MockObject $client */
        $client = $this->getMockBuilder(Client::class)
            ->setMethods(['fetchResponse'])
            ->setConstructorArgs([new Options()])
            ->getMock();
        $client->expects($this->once())
            ->method('fetchResponse')
            ->with($clientRequest)
            ->willThrowException(new BadRequestException('test', ''));

        $this->expectException(BadRequestException::class);

        $pendingResponse = new PendingResponse($client, $clientRequest);
        $this->assertEquals($responseData, $pendingResponse->fetchResponse());
    }
}

<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client;

use Exception;
use FactorioItemBrowser\Api\Client\Client;
use FactorioItemBrowser\Api\Client\Endpoint\EndpointInterface;
use FactorioItemBrowser\Api\Client\Exception\ClientException;
use FactorioItemBrowser\Api\Client\Exception\ConnectionException;
use FactorioItemBrowser\Api\Client\Exception\ErrorResponseException;
use FactorioItemBrowser\Api\Client\Exception\InvalidResponseException;
use FactorioItemBrowser\Api\Client\Exception\UnhandledRequestException;
use FactorioItemBrowser\Api\Client\Request\AbstractRequest;
use FactorioItemBrowserTestAsset\Api\Client\TestEndpoint;
use FactorioItemBrowserTestAsset\Api\Client\TestRequest;
use FactorioItemBrowserTestAsset\Api\Client\TestResponse;
use GuzzleHttp\ClientInterface as GuzzleClientInterface;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Promise\FulfilledPromise;
use GuzzleHttp\Promise\RejectedPromise;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use JMS\Serializer\SerializerInterface;
use PHPUnit\Framework\Constraint\Callback;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

/**
 * The PHPUnit test of the ApiClient class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Client
 */
class ClientTest extends TestCase
{
    private function assertRequestEquals(RequestInterface $expectedRequest, RequestInterface $actualRequest): void
    {
        $expectedBody = $expectedRequest->getBody();
        $actualBody = $actualRequest->getBody();
        $this->assertSame($expectedBody->getContents(), $actualBody->getContents());

        $dummyBody = $this->createMock(StreamInterface::class);
        $this->assertEquals($expectedRequest->withBody($dummyBody), $actualRequest->withBody($dummyBody));
    }

    /**
     * @throws ClientException
     */
    public function testSendRequest(): void
    {
        $request = new TestRequest();
        $request->foo = 'abc';
        $request->locale = 'foo';
        $response = new TestResponse();
        $response->foo = 'def';
        $serializedRequest = 'cba';
        $serializedResponse = 'fed';

        $endpoint = new TestEndpoint();
        /** @var EndpointInterface<AbstractRequest, object> $endpoint */

        $serializer = $this->createMock(SerializerInterface::class);
        $serializer->expects($this->once())
                   ->method('serialize')
                   ->with($this->identicalTo($request), $this->identicalTo('json'))
                   ->willReturn($serializedRequest);
        $serializer->expects($this->once())
                   ->method('deserialize')
                   ->with(
                       $this->identicalTo($serializedResponse),
                       $this->identicalTo(TestResponse::class),
                       $this->identicalTo('json'),
                   )
                   ->willReturn($response);

        $expectedClientRequest = new Request(
            'POST',
            'test',
            [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Accept-Language' => 'foo',
            ],
            $serializedRequest,
        );

        $promise = new FulfilledPromise(new Response(200, [], $serializedResponse));

        $guzzleClient = $this->createMock(GuzzleClientInterface::class);
        $guzzleClient->expects($this->once())
                     ->method('sendAsync')
                     ->with(new Callback(function ($request) use ($expectedClientRequest): bool {
                         $this->assertRequestEquals($expectedClientRequest, $request);
                         return true;
                     }))
                     ->willReturn($promise);

        $client = new Client($guzzleClient, $serializer, [$endpoint]);
        $result = $client->sendRequest($request)->wait();
        $this->assertEquals($response, $result);
    }

    /**
     * @throws ClientException
     */
    public function testSendRequestWithoutEndpoint(): void
    {
        $request = new TestRequest();

        $serializer = $this->createMock(SerializerInterface::class);
        $serializer->expects($this->never())
                   ->method('serialize');
        $serializer->expects($this->never())
                   ->method('deserialize');

        $guzzleClient = $this->createMock(GuzzleClientInterface::class);
        $guzzleClient->expects($this->never())
                     ->method('sendAsync');

        $this->expectException(UnhandledRequestException::class);

        $client = new Client($guzzleClient, $serializer, []);
        $client->sendRequest($request)->wait();
    }

    /**
     * @throws ClientException
     */
    public function testSendRequestWithInvalidResponse(): void
    {
        $request = new TestRequest();
        $request->foo = 'abc';
        $request->locale = 'foo';
        $response = new TestResponse();
        $response->foo = 'def';
        $serializedRequest = 'cba';
        $serializedResponse = 'fed';

        $endpoint = new TestEndpoint();
        /** @var EndpointInterface<AbstractRequest, object> $endpoint */

        $serializer = $this->createMock(SerializerInterface::class);
        $serializer->expects($this->once())
                   ->method('serialize')
                   ->with($this->identicalTo($request), $this->identicalTo('json'))
                   ->willReturn($serializedRequest);
        $serializer->expects($this->once())
                   ->method('deserialize')
                   ->with(
                       $this->identicalTo($serializedResponse),
                       $this->identicalTo(TestResponse::class),
                       $this->identicalTo('json'),
                   )
                   ->willThrowException(new Exception('test exception'));

        $expectedClientRequest = new Request(
            'POST',
            'test',
            [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Accept-Language' => 'foo',
            ],
            $serializedRequest,
        );

        $promise = new FulfilledPromise(new Response(200, [], $serializedResponse));

        $guzzleClient = $this->createMock(GuzzleClientInterface::class);
        $guzzleClient->expects($this->once())
                     ->method('sendAsync')
                     ->with(new Callback(function ($request) use ($expectedClientRequest): bool {
                         $this->assertRequestEquals($expectedClientRequest, $request);
                         return true;
                     }))
                     ->willReturn($promise);

        $this->expectException(InvalidResponseException::class);

        $client = new Client($guzzleClient, $serializer, [$endpoint]);
        $client->sendRequest($request)->wait();
    }

    /**
     * @throws ClientException
     */
    public function testSendRequestWithConnectException(): void
    {
        $request = new TestRequest();
        $request->foo = 'abc';
        $request->locale = 'foo';
        $serializedRequest = 'cba';

        $endpoint = new TestEndpoint();
        /** @var EndpointInterface<AbstractRequest, object> $endpoint */

        $serializer = $this->createMock(SerializerInterface::class);
        $serializer->expects($this->once())
                   ->method('serialize')
                   ->with($this->identicalTo($request), $this->identicalTo('json'))
                   ->willReturn($serializedRequest);
        $serializer->expects($this->never())
                   ->method('deserialize');

        $expectedClientRequest = new Request(
            'POST',
            'test',
            [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Accept-Language' => 'foo',
            ],
            $serializedRequest,
        );

        $promise = new RejectedPromise(new ConnectException('test exception', $expectedClientRequest));

        $guzzleClient = $this->createMock(GuzzleClientInterface::class);
        $guzzleClient->expects($this->once())
                     ->method('sendAsync')
                     ->with(new Callback(function ($request) use ($expectedClientRequest): bool {
                         $this->assertRequestEquals($expectedClientRequest, $request);
                         return true;
                     }))
                     ->willReturn($promise);

        $this->expectException(ConnectionException::class);

        $client = new Client($guzzleClient, $serializer, [$endpoint]);
        $client->sendRequest($request)->wait();
    }

    /**
     * @return array<mixed>
     */
    public function provideSendRequest(): array
    {
        return [
            [new Response(500, [], (string) json_encode(['message' => 'response error'])), 'response error'],
            [new Response(500, [], (string) json_encode(['foo' => 'bar'])), 'test exception'],
            [new Response(500, [], '{invalid'), 'test exception'],
            [null, 'test exception'],
        ];
    }

    /**
     * @param ResponseInterface|null $response
     * @param string $exceptionMessage
     * @throws ClientException
     * @dataProvider provideSendRequest
     */
    public function testSendRequestWithErrorResponse(?ResponseInterface $response, string $exceptionMessage): void
    {
        $request = new TestRequest();
        $request->foo = 'abc';
        $request->locale = 'foo';
        $serializedRequest = 'cba';

        $endpoint = new TestEndpoint();
        /** @var EndpointInterface<AbstractRequest, object> $endpoint */

        $serializer = $this->createMock(SerializerInterface::class);
        $serializer->expects($this->once())
                   ->method('serialize')
                   ->with($this->identicalTo($request), $this->identicalTo('json'))
                   ->willReturn($serializedRequest);
        $serializer->expects($this->never())
                   ->method('deserialize');

        $expectedClientRequest = new Request(
            'POST',
            'test',
            [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Accept-Language' => 'foo',
            ],
            $serializedRequest,
        );

        $exception = new RequestException('test exception', $expectedClientRequest, $response);
        $promise = new RejectedPromise($exception);

        $guzzleClient = $this->createMock(GuzzleClientInterface::class);
        $guzzleClient->expects($this->once())
                     ->method('sendAsync')
                     ->with(new Callback(function ($request) use ($expectedClientRequest): bool {
                         $this->assertRequestEquals($expectedClientRequest, $request);
                         return true;
                     }))
                     ->willReturn($promise);

        $this->expectException(ErrorResponseException::class);
        $this->expectDeprecationMessage($exceptionMessage);

        $client = new Client($guzzleClient, $serializer, [$endpoint]);
        $client->sendRequest($request)->wait();
    }
}

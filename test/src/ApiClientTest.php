<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client;

use BluePsyduck\Common\Test\ReflectionTrait;
use Exception;
use FactorioItemBrowser\Api\Client\ApiClient;
use FactorioItemBrowser\Api\Client\Client\Options;
use FactorioItemBrowser\Api\Client\Endpoint\EndpointInterface;
use FactorioItemBrowser\Api\Client\Entity\Error;
use FactorioItemBrowser\Api\Client\Exception\ApiClientException;
use FactorioItemBrowser\Api\Client\Exception\InvalidResponseException;
use FactorioItemBrowser\Api\Client\Request\Auth\AuthRequest;
use FactorioItemBrowser\Api\Client\Request\RequestInterface;
use FactorioItemBrowser\Api\Client\Response\Auth\AuthResponse;
use FactorioItemBrowser\Api\Client\Response\ErrorResponse;
use FactorioItemBrowser\Api\Client\Response\ResponseInterface;
use FactorioItemBrowser\Api\Client\Service\EndpointService;
use GuzzleHttp\Client;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Psr7\Request;
use JMS\Serializer\SerializerInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\MessageInterface as PsrMessageInterface;
use Psr\Http\Message\RequestInterface as PsrRequestInterface;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;
use Psr\Http\Message\StreamInterface;
use ReflectionException;

/**
 * The PHPUnit test of the ApiClient class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\ApiClient
 */
class ApiClientTest extends TestCase
{
    use ReflectionTrait;

    /**
     * The mocked endpoint service.
     * @var EndpointService&MockObject
     */
    protected $endpointService;

    /**
     * The mocked guzzle client.
     * @var Client&MockObject
     */
    protected $guzzleClient;

    /**
     * The mocked options.
     * @var Options&MockObject
     */
    protected $options;

    /**
     * The mocked serializer.
     * @var SerializerInterface&MockObject
     */
    protected $serializer;

    /**
     * Sets up the test case.
     * @throws ReflectionException
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->endpointService = $this->createMock(EndpointService::class);
        $this->guzzleClient = $this->createMock(Client::class);
        $this->options = $this->createMock(Options::class);
        $this->serializer = $this->createMock(SerializerInterface::class);
    }

    /**
     * Tests the constructing.
     * @throws ReflectionException
     * @covers ::__construct
     */
    public function testConstruct(): void
    {
        $apiClient = new ApiClient($this->endpointService, $this->guzzleClient, $this->options, $this->serializer);

        $this->assertSame($this->endpointService, $this->extractProperty($apiClient, 'endpointService'));
        $this->assertSame($this->guzzleClient, $this->extractProperty($apiClient, 'guzzleClient'));
        $this->assertSame($this->options, $this->extractProperty($apiClient, 'options'));
        $this->assertSame($this->serializer, $this->extractProperty($apiClient, 'serializer'));
    }

    /**
     * Tests the sendRequest method.
     * @throws ApiClientException
     * @throws ReflectionException
     * @covers ::sendRequest
     */
    public function testSendRequest(): void
    {
        $requestId = 42;

        /* @var RequestInterface&MockObject $request */
        $request = $this->createMock(RequestInterface::class);
        /* @var PromiseInterface&MockObject $promise1 */
        $promise1 = $this->createMock(PromiseInterface::class);
        /* @var PromiseInterface&MockObject $promise2 */
        $promise2 = $this->createMock(PromiseInterface::class);

        $pendingRequests = [
            21 => $promise1,
        ];
        $expectedPendingRequests = [
            21 => $promise1,
            42 => $promise2,
        ];

        /* @var ApiClient&MockObject $apiClient */
        $apiClient = $this->getMockBuilder(ApiClient::class)
                          ->setMethods(['getRequestId', 'createPromiseForRequest'])
                          ->setConstructorArgs([
                              $this->endpointService,
                              $this->guzzleClient,
                              $this->options,
                              $this->serializer
                          ])
                          ->getMock();
        $apiClient->expects($this->once())
                  ->method('getRequestId')
                  ->with($this->identicalTo($request))
                  ->willReturn($requestId);
        $apiClient->expects($this->once())
                  ->method('createPromiseForRequest')
                  ->with($this->identicalTo($request))
                  ->willReturn($promise2);
        $this->injectProperty($apiClient, 'pendingRequests', $pendingRequests);

        $apiClient->sendRequest($request);

        $this->assertEquals($expectedPendingRequests, $this->extractProperty($apiClient, 'pendingRequests'));
    }

    /**
     * Tests the fetchResponse method.
     * @throws ApiClientException
     * @throws ReflectionException
     * @covers ::fetchResponse
     */
    public function testFetchResponse(): void
    {
        $requestId = 42;

        /* @var RequestInterface&MockObject $request */
        $request = $this->createMock(RequestInterface::class);
        /* @var ResponseInterface&MockObject $response */
        $response = $this->createMock(ResponseInterface::class);

        /* @var PromiseInterface&MockObject $promise1 */
        $promise1 = $this->createMock(PromiseInterface::class);
        $promise1->expects($this->once())
                 ->method('wait')
                 ->willReturn($response);

        /* @var PromiseInterface&MockObject $promise2 */
        $promise2 = $this->createMock(PromiseInterface::class);

        $pendingRequests = [
            42 => $promise1,
            1337 => $promise2,
        ];
        $expectedPendingRequests = [
            1337 => $promise2,
        ];

        /* @var ApiClient&MockObject $apiClient */
        $apiClient = $this->getMockBuilder(ApiClient::class)
                          ->setMethods(['getRequestId', 'createPromiseForRequest'])
                          ->setConstructorArgs([
                              $this->endpointService,
                              $this->guzzleClient,
                              $this->options,
                              $this->serializer
                          ])
                          ->getMock();
        $apiClient->expects($this->once())
                  ->method('getRequestId')
                  ->with($this->identicalTo($request))
                  ->willReturn($requestId);
        $apiClient->expects($this->never())
                  ->method('createPromiseForRequest');
        $this->injectProperty($apiClient, 'pendingRequests', $pendingRequests);

        $result = $apiClient->fetchResponse($request);

        $this->assertSame($response, $result);
        $this->assertSame($expectedPendingRequests, $this->extractProperty($apiClient, 'pendingRequests'));
    }

    /**
     * Tests the fetchResponse method with a still missing pending request.
     * @throws ApiClientException
     * @throws ReflectionException
     * @covers ::fetchResponse
     */
    public function testFetchResponseWithMissingRequest(): void
    {
        $requestId = 42;

        /* @var RequestInterface&MockObject $request */
        $request = $this->createMock(RequestInterface::class);
        /* @var ResponseInterface&MockObject $response */
        $response = $this->createMock(ResponseInterface::class);

        /* @var PromiseInterface&MockObject $promise1 */
        $promise1 = $this->createMock(PromiseInterface::class);
        $promise1->expects($this->once())
                 ->method('wait')
                 ->willReturn($response);

        /* @var PromiseInterface&MockObject $promise2 */
        $promise2 = $this->createMock(PromiseInterface::class);

        $pendingRequests = [
            1337 => $promise2,
        ];
        $expectedPendingRequests = [
            1337 => $promise2,
        ];

        /* @var ApiClient&MockObject $apiClient */
        $apiClient = $this->getMockBuilder(ApiClient::class)
                          ->setMethods(['getRequestId', 'createPromiseForRequest'])
                          ->setConstructorArgs([
                              $this->endpointService,
                              $this->guzzleClient,
                              $this->options,
                              $this->serializer
                          ])
                          ->getMock();
        $apiClient->expects($this->once())
                  ->method('getRequestId')
                  ->with($this->identicalTo($request))
                  ->willReturn($requestId);
        $apiClient->expects($this->once())
                  ->method('createPromiseForRequest')
                  ->with($this->identicalTo($request))
                  ->willReturn($promise1);
        $this->injectProperty($apiClient, 'pendingRequests', $pendingRequests);

        $result = $apiClient->fetchResponse($request);

        $this->assertSame($response, $result);
        $this->assertSame($expectedPendingRequests, $this->extractProperty($apiClient, 'pendingRequests'));
    }

    /**
     * Tests the fetchResponse method with throwing an exception.
     * @throws ApiClientException
     * @throws ReflectionException
     * @covers ::fetchResponse
     */
    public function testFetchResponseWithException(): void
    {
        $requestId = 42;

        /* @var RequestInterface&MockObject $request */
        $request = $this->createMock(RequestInterface::class);

        /* @var PromiseInterface&MockObject $promise1 */
        $promise1 = $this->createMock(PromiseInterface::class);
        $promise1->expects($this->once())
                 ->method('wait')
                 ->willThrowException(new ApiClientException('abc'));

        /* @var PromiseInterface&MockObject $promise2 */
        $promise2 = $this->createMock(PromiseInterface::class);

        $pendingRequests = [
            42 => $promise1,
            1337 => $promise2,
        ];
        $expectedPendingRequests = [
            1337 => $promise2,
        ];

        $this->expectException(ApiClientException::class);

        /* @var ApiClient&MockObject $apiClient */
        $apiClient = $this->getMockBuilder(ApiClient::class)
                          ->setMethods(['getRequestId', 'createPromiseForRequest'])
                          ->setConstructorArgs([
                              $this->endpointService,
                              $this->guzzleClient,
                              $this->options,
                              $this->serializer
                          ])
                          ->getMock();
        $apiClient->expects($this->once())
                  ->method('getRequestId')
                  ->with($this->identicalTo($request))
                  ->willReturn($requestId);
        $apiClient->expects($this->never())
                  ->method('createPromiseForRequest');
        $this->injectProperty($apiClient, 'pendingRequests', $pendingRequests);

        $apiClient->fetchResponse($request);

        $this->assertSame($expectedPendingRequests, $this->extractProperty($apiClient, 'pendingRequests'));
    }

    /**
     * Tests the getRequestId method.
     * @throws ReflectionException
     * @covers ::getRequestId
     */
    public function testGetRequestId(): void
    {
        /* @var RequestInterface&MockObject $request1 */
        $request1 = $this->createMock(RequestInterface::class);
        /* @var RequestInterface&MockObject $request2 */
        $request2 = $this->createMock(RequestInterface::class);

        $apiClient = new ApiClient($this->endpointService, $this->guzzleClient, $this->options, $this->serializer);
        $result1 = $this->invokeMethod($apiClient, 'getRequestId', $request1);
        $result2 = $this->invokeMethod($apiClient, 'getRequestId', $request2);

        $this->assertNotEquals($result1, $result2);
    }

    /**
     * Tests the createClientRequest method.
     * @throws ReflectionException
     * @covers ::createClientRequest
     */
    public function testCreateClientRequest(): void
    {
        $requestPath = 'abc';
        $serializedRequest = 'def';
        $headers = ['ghi' => 'jkl'];
        $expectedHeaders = ['ghi' => ['jkl']];

        /* @var RequestInterface&MockObject $request */
        $request = $this->createMock(RequestInterface::class);

        /* @var EndpointInterface&MockObject $endpoint */
        $endpoint = $this->createMock(EndpointInterface::class);
        $endpoint->expects($this->once())
                 ->method('getRequestPath')
                 ->willReturn($requestPath);

        $this->endpointService->expects($this->once())
                              ->method('getEndpointForRequest')
                              ->with($this->identicalTo($request))
                              ->willReturn($endpoint);

        $this->serializer->expects($this->once())
                         ->method('serialize')
                         ->with($this->identicalTo($request))
                         ->willReturn($serializedRequest);

        /* @var ApiClient&MockObject $apiClient */
        $apiClient = $this->getMockBuilder(ApiClient::class)
                          ->setMethods(['getRequestHeaders'])
                          ->setConstructorArgs([
                              $this->endpointService,
                              $this->guzzleClient,
                              $this->options,
                              $this->serializer
                          ])
                          ->getMock();
        $apiClient->expects($this->once())
                  ->method('getRequestHeaders')
                  ->with($this->identicalTo($endpoint))
                  ->willReturn($headers);

        $result = $this->invokeMethod($apiClient, 'createClientRequest', $request);

        $this->assertInstanceOf(Request::class, $result);
        /* @var Request $result */
        $this->assertSame('POST', $result->getMethod());
        $this->assertSame($requestPath, $result->getRequestTarget());
        $this->assertEquals($expectedHeaders, $result->getHeaders());
        $this->assertSame($serializedRequest, $result->getBody()->getContents());
    }

    /**
     * Tests the getRequestHeaders method with using the authorization token.
     * @throws ReflectionException
     * @covers ::getRequestHeaders
     */
    public function testGetRequestHeadersWithAuthorization(): void
    {
        $locale = 'abc';
        $authorizationToken = 'def';
        $expectedResult = [
            'Accept' => 'application/json',
            'Accept-Language' => 'abc',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer def',
        ];

        /* @var EndpointInterface&MockObject $endpoint */
        $endpoint = $this->createMock(EndpointInterface::class);
        $endpoint->expects($this->once())
                 ->method('requiresAuthorizationToken')
                 ->willReturn(true);

        $this->options->expects($this->once())
                      ->method('getLocale')
                      ->willReturn($locale);

        /* @var ApiClient&MockObject $apiClient */
        $apiClient = $this->getMockBuilder(ApiClient::class)
                          ->setMethods(['requestAuthorizationToken'])
                          ->setConstructorArgs([
                              $this->endpointService,
                              $this->guzzleClient,
                              $this->options,
                              $this->serializer
                          ])
                          ->getMock();
        $apiClient->expects($this->once())
                  ->method('requestAuthorizationToken')
                  ->willReturn($authorizationToken);

        $result = $this->invokeMethod($apiClient, 'getRequestHeaders', $endpoint);

        $this->assertEquals($expectedResult, $result);
    }

    /**
     * Tests the getRequestHeaders method without using an authorization token.
     * @throws ReflectionException
     * @covers ::getRequestHeaders
     */
    public function testGetRequestHeadersWithoutAuthorization(): void
    {
        $locale = 'abc';
        $expectedResult = [
            'Accept' => 'application/json',
            'Accept-Language' => 'abc',
            'Content-Type' => 'application/json',
        ];

        /* @var EndpointInterface&MockObject $endpoint */
        $endpoint = $this->createMock(EndpointInterface::class);
        $endpoint->expects($this->once())
                 ->method('requiresAuthorizationToken')
                 ->willReturn(false);

        $this->options->expects($this->once())
                      ->method('getLocale')
                      ->willReturn($locale);

        /* @var ApiClient&MockObject $apiClient */
        $apiClient = $this->getMockBuilder(ApiClient::class)
                          ->setMethods(['requestAuthorizationToken'])
                          ->setConstructorArgs([
                              $this->endpointService,
                              $this->guzzleClient,
                              $this->options,
                              $this->serializer
                          ])
                          ->getMock();
        $apiClient->expects($this->never())
                  ->method('requestAuthorizationToken');

        $result = $this->invokeMethod($apiClient, 'getRequestHeaders', $endpoint);

        $this->assertEquals($expectedResult, $result);
    }

    /**
     * Tests the requestAuthorizationToken method without an already existing token.
     * @throws ReflectionException
     * @covers ::requestAuthorizationToken
     */
    public function testRequestAuthorizationTokenWithoutExistingToken(): void
    {
        $authorizationToken = 'abc';
        $agent = 'def';
        $accessKey = 'ghi';
        $enabledModNames = ['jkl', 'mno'];

        $expectedRequest = new AuthRequest();
        $expectedRequest->setAgent($agent)
                        ->setAccessKey($accessKey)
                        ->setEnabledModNames($enabledModNames);

        /* @var AuthResponse&MockObject $response */
        $response = $this->createMock(AuthResponse::class);
        $response->expects($this->once())
                 ->method('getAuthorizationToken')
                 ->willReturn($authorizationToken);

        $this->options->expects($this->once())
                      ->method('getAuthorizationToken')
                      ->willReturn('');
        $this->options->expects($this->once())
                      ->method('getAgent')
                      ->willReturn($agent);
        $this->options->expects($this->once())
                      ->method('getAccessKey')
                      ->willReturn($accessKey);
        $this->options->expects($this->once())
                      ->method('getEnabledModNames')
                      ->willReturn($enabledModNames);
        $this->options->expects($this->once())
                      ->method('setAuthorizationToken')
                      ->with($this->identicalTo($authorizationToken));

        /* @var ApiClient&MockObject $apiClient */
        $apiClient = $this->getMockBuilder(ApiClient::class)
                          ->setMethods(['fetchResponse'])
                          ->setConstructorArgs([
                              $this->endpointService,
                              $this->guzzleClient,
                              $this->options,
                              $this->serializer
                          ])
                          ->getMock();
        $apiClient->expects($this->once())
                  ->method('fetchResponse')
                  ->with($this->equalTo($expectedRequest))
                  ->willReturn($response);

        $result = $this->invokeMethod($apiClient, 'requestAuthorizationToken');

        $this->assertSame($authorizationToken, $result);
    }

    /**
     * Tests the requestAuthorizationToken method with an already existing token.
     * @throws ReflectionException
     * @covers ::requestAuthorizationToken
     */
    public function testRequestAuthorizationTokenWithExistingToken(): void
    {
        $authorizationToken = 'abc';

        $this->options->expects($this->once())
                      ->method('getAuthorizationToken')
                      ->willReturn($authorizationToken);

        /* @var ApiClient&MockObject $apiClient */
        $apiClient = $this->getMockBuilder(ApiClient::class)
                          ->setMethods(['fetchResponse'])
                          ->setConstructorArgs([
                              $this->endpointService,
                              $this->guzzleClient,
                              $this->options,
                              $this->serializer
                          ])
                          ->getMock();
        $apiClient->expects($this->never())
                  ->method('fetchResponse');

        $result = $this->invokeMethod($apiClient, 'requestAuthorizationToken');

        $this->assertSame($authorizationToken, $result);
    }

    /**
     * Tests the processResponse method.
     * @throws ReflectionException
     * @covers ::processResponse
     */
    public function testProcessResponse(): void
    {
        $responseClass = 'abc';
        $responseContents = 'def';

        /* @var RequestInterface&MockObject $request */
        $request = $this->createMock(RequestInterface::class);
        /* @var PsrRequestInterface&MockObject $clientRequest */
        $clientRequest = $this->createMock(PsrRequestInterface::class);
        /* @var PsrResponseInterface&MockObject $clientResponse */
        $clientResponse = $this->createMock(PsrResponseInterface::class);
        /* @var ResponseInterface&MockObject $response */
        $response = $this->createMock(ResponseInterface::class);

        /* @var EndpointInterface&MockObject $endpoint */
        $endpoint = $this->createMock(EndpointInterface::class);
        $endpoint->expects($this->once())
                 ->method('getResponseClass')
                 ->willReturn($responseClass);

        $this->endpointService->expects($this->once())
                              ->method('getEndpointForRequest')
                              ->with($this->identicalTo($request))
                              ->willReturn($endpoint);

        $this->serializer->expects($this->once())
                         ->method('deserialize')
                         ->with(
                             $this->identicalTo($responseContents),
                             $this->identicalTo($responseClass),
                             $this->identicalTo('json')
                         )
                         ->willReturn($response);


        /* @var ApiClient&MockObject $apiClient */
        $apiClient = $this->getMockBuilder(ApiClient::class)
                          ->setMethods(['getContentsFromMessage'])
                          ->setConstructorArgs([
                              $this->endpointService,
                              $this->guzzleClient,
                              $this->options,
                              $this->serializer
                          ])
                          ->getMock();
        $apiClient->expects($this->once())
                  ->method('getContentsFromMessage')
                  ->with($this->identicalTo($clientResponse))
                  ->willReturn($responseContents);

        $result = $this->invokeMethod($apiClient, 'processResponse', $request, $clientRequest, $clientResponse);

        $this->assertSame($response, $result);
    }

    /**
     * Tests the processResponse method with throwing an exception.
     * @throws ReflectionException
     * @covers ::processResponse
     */
    public function testProcessResponseWithException(): void
    {
        $responseClass = 'abc';
        $responseContents = 'def';
        $requestContents = 'ghi';
        $exceptionMessage = 'jkl';

        $exception = new Exception($exceptionMessage);

        /* @var RequestInterface&MockObject $request */
        $request = $this->createMock(RequestInterface::class);
        /* @var PsrRequestInterface&MockObject $clientRequest */
        $clientRequest = $this->createMock(PsrRequestInterface::class);
        /* @var PsrResponseInterface&MockObject $clientResponse */
        $clientResponse = $this->createMock(PsrResponseInterface::class);

        /* @var EndpointInterface&MockObject $endpoint */
        $endpoint = $this->createMock(EndpointInterface::class);
        $endpoint->expects($this->once())
                 ->method('getResponseClass')
                 ->willReturn($responseClass);

        $this->endpointService->expects($this->once())
                              ->method('getEndpointForRequest')
                              ->with($this->identicalTo($request))
                              ->willReturn($endpoint);

        $this->serializer->expects($this->once())
                         ->method('deserialize')
                         ->with(
                             $this->identicalTo($responseContents),
                             $this->identicalTo($responseClass),
                             $this->identicalTo('json')
                         )
                         ->willThrowException(new Exception($exceptionMessage));

        $this->expectExceptionObject(
            new InvalidResponseException($exceptionMessage, $requestContents, $responseContents, $exception)
        );

        /* @var ApiClient&MockObject $apiClient */
        $apiClient = $this->getMockBuilder(ApiClient::class)
                          ->setMethods(['getContentsFromMessage'])
                          ->setConstructorArgs([
                              $this->endpointService,
                              $this->guzzleClient,
                              $this->options,
                              $this->serializer
                          ])
                          ->getMock();
        $apiClient->expects($this->exactly(2))
                  ->method('getContentsFromMessage')
                  ->withConsecutive(
                      [$this->identicalTo($clientResponse)],
                      [$this->identicalTo($clientRequest)]
                  )
                  ->willReturnOnConsecutiveCalls(
                      $responseContents,
                      $requestContents
                  );

        $this->invokeMethod($apiClient, 'processResponse', $request, $clientRequest, $clientResponse);
    }

    /**
     * Tests the getContentsFromMessage method.
     * @throws ReflectionException
     * @covers ::getContentsFromMessage
     */
    public function testGetContentsFromMessage(): void
    {
        $contents = 'abc';

        /* @var StreamInterface&MockObject $stream */
        $stream = $this->createMock(StreamInterface::class);
        $stream->expects($this->once())
               ->method('getContents')
               ->willReturn($contents);

        /* @var PsrMessageInterface&MockObject $message */
        $message = $this->createMock(PsrMessageInterface::class);
        $message->expects($this->once())
                ->method('getBody')
                ->willReturn($stream);

        $apiClient = new ApiClient($this->endpointService, $this->guzzleClient, $this->options, $this->serializer);
        $result = $this->invokeMethod($apiClient, 'getContentsFromMessage', $message);

        $this->assertSame($contents, $result);
    }

    /**
     * Tests the extractMessageFromErrorResponse method.
     * @throws ReflectionException
     * @covers ::extractMessageFromErrorResponse
     */
    public function testExtractMessageFromErrorResponse(): void
    {
        $responseContents = 'abc';
        $fallbackMessage = 'def';
        $errorMessage = 'ghi';

        /* @var Error&MockObject $error */
        $error = $this->createMock(Error::class);
        $error->expects($this->once())
              ->method('getMessage')
              ->willReturn($errorMessage);

        /* @var ErrorResponse&MockObject $errorResponse */
        $errorResponse = $this->createMock(ErrorResponse::class);
        $errorResponse->expects($this->once())
                      ->method('getError')
                      ->willReturn($error);

        $this->serializer->expects($this->once())
                         ->method('deserialize')
                         ->with(
                             $this->identicalTo($responseContents),
                             $this->identicalTo(ErrorResponse::class),
                             $this->identicalTo('json')
                         )
                         ->willReturn($errorResponse);

        $apiClient = new ApiClient($this->endpointService, $this->guzzleClient, $this->options, $this->serializer);
        $result = $this->invokeMethod(
            $apiClient,
            'extractMessageFromErrorResponse',
            $responseContents,
            $fallbackMessage
        );

        $this->assertSame($errorMessage, $result);
    }

    /**
     * Tests the extractMessageFromErrorResponse method with throwing an exception.
     * @throws ReflectionException
     * @covers ::extractMessageFromErrorResponse
     */
    public function testExtractMessageFromErrorResponseWithException(): void
    {
        $responseContents = 'abc';
        $fallbackMessage = 'def';

        $this->serializer->expects($this->once())
                         ->method('deserialize')
                         ->with(
                             $this->identicalTo($responseContents),
                             $this->identicalTo(ErrorResponse::class),
                             $this->identicalTo('json')
                         )
                         ->willThrowException($this->createMock(Exception::class));

        $apiClient = new ApiClient($this->endpointService, $this->guzzleClient, $this->options, $this->serializer);
        $result = $this->invokeMethod(
            $apiClient,
            'extractMessageFromErrorResponse',
            $responseContents,
            $fallbackMessage
        );

        $this->assertSame($fallbackMessage, $result);
    }


    /**
     * Tests the getContentsFromMessage method without an actual message instance.
     * @throws ReflectionException
     * @covers ::getContentsFromMessage
     */
    public function testGetContentsFromMessageWithoutMessage(): void
    {
        $message = null;
        $expectedResult = '';

        $apiClient = new ApiClient($this->endpointService, $this->guzzleClient, $this->options, $this->serializer);
        $result = $this->invokeMethod($apiClient, 'getContentsFromMessage', $message);

        $this->assertSame($expectedResult, $result);
    }
}

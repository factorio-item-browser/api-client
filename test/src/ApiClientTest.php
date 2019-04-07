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
use FactorioItemBrowser\Api\Client\Exception\BadRequestException;
use FactorioItemBrowser\Api\Client\Exception\ConnectionException;
use FactorioItemBrowser\Api\Client\Exception\ForbiddenException;
use FactorioItemBrowser\Api\Client\Exception\InvalidResponseException;
use FactorioItemBrowser\Api\Client\Exception\NotFoundException;
use FactorioItemBrowser\Api\Client\Exception\UnauthorizedException;
use FactorioItemBrowser\Api\Client\Request\Auth\AuthRequest;
use FactorioItemBrowser\Api\Client\Request\RequestInterface;
use FactorioItemBrowser\Api\Client\Response\Auth\AuthResponse;
use FactorioItemBrowser\Api\Client\Response\ErrorResponse;
use FactorioItemBrowser\Api\Client\Response\ResponseInterface;
use FactorioItemBrowser\Api\Client\Service\EndpointService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
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
     * Tests the setLocale method.
     * @covers ::setLocale
     */
    public function testSetLocale(): void
    {
        $locale = 'abc';

        $this->options->expects($this->once())
                      ->method('setLocale')
                      ->with($this->identicalTo($locale));

        $apiClient = new ApiClient($this->endpointService, $this->guzzleClient, $this->options, $this->serializer);
        $apiClient->setLocale($locale);
    }

    /**
     * Tests the setEnabledModNames method.
     * @covers ::setEnabledModNames
     */
    public function testSetEnabledModNames(): void
    {
        $enabledModNames = ['abc', 'def'];

        $this->options->expects($this->once())
                      ->method('setEnabledModNames')
                      ->with($this->identicalTo($enabledModNames));

        $apiClient = new ApiClient($this->endpointService, $this->guzzleClient, $this->options, $this->serializer);
        $apiClient->setEnabledModNames($enabledModNames);
    }

    /**
     * Tests the setAuthorizationToken method.
     * @covers ::setAuthorizationToken
     */
    public function testSetAuthorizationToken(): void
    {
        $authorizationToken = 'abc';

        $this->options->expects($this->once())
                      ->method('setAuthorizationToken')
                      ->with($this->identicalTo($authorizationToken));

        $apiClient = new ApiClient($this->endpointService, $this->guzzleClient, $this->options, $this->serializer);
        $apiClient->setAuthorizationToken($authorizationToken);
    }

    /**
     * Tests the getAuthorizationToken method.
     * @covers ::getAuthorizationToken
     */
    public function testGetAuthorizationToken(): void
    {
        $authorizationToken = 'abc';

        $this->options->expects($this->once())
                      ->method('getAuthorizationToken')
                      ->willReturn($authorizationToken);

        $apiClient = new ApiClient($this->endpointService, $this->guzzleClient, $this->options, $this->serializer);
        $result = $apiClient->getAuthorizationToken();

        $this->assertSame($authorizationToken, $result);
    }

    /**
     * Tests the clearAuthorizationToken method.
     * @covers ::clearAuthorizationToken
     */
    public function testClearAuthorizationToken(): void
    {
        $this->options->expects($this->once())
                      ->method('setAuthorizationToken')
                      ->with($this->identicalTo(''));

        $apiClient = new ApiClient($this->endpointService, $this->guzzleClient, $this->options, $this->serializer);
        $apiClient->clearAuthorizationToken();
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
     * Tests the createPromiseForRequest method with setting the processApiException flag.
     * @throws ReflectionException
     * @covers ::createPromiseForRequest
     */
    public function testCreatePromiseForRequestWithProcessApiException(): void
    {
        /* @var RequestInterface&MockObject $request */
        $request = $this->createMock(RequestInterface::class);
        /* @var PsrRequestInterface&MockObject $clientRequest */
        $clientRequest = $this->createMock(PsrRequestInterface::class);
        /* @var RequestException&MockObject $requestException */
        $requestException = $this->createMock(RequestException::class);
        /* @var ApiClientException&MockObject $apiClientException */
        $apiClientException = $this->createMock(ApiClientException::class);
        /* @var ResponseInterface&MockObject $response1 */
        $response1 = $this->createMock(ResponseInterface::class);
        /* @var ResponseInterface&MockObject $response2 */
        $response2 = $this->createMock(ResponseInterface::class);
        /* @var PsrResponseInterface&MockObject $clientResponse */
        $clientResponse = $this->createMock(PsrResponseInterface::class);

        /* @var PromiseInterface&MockObject $promise3 */
        $promise3 = $this->createMock(PromiseInterface::class);

        /* @var PromiseInterface&MockObject $promise2 */
        $promise2 = $this->createMock(PromiseInterface::class);
        $promise2->expects($this->once())
                 ->method('then')
                 ->with(
                     $this->isNull(),
                     $this->callback(function ($callback) use ($apiClientException, $response2) {
                         $this->assertIsCallable($callback);

                         $result = $callback($apiClientException);
                         $this->assertSame($response2, $result);
                         return true;
                     })
                 )
                 ->willReturn($promise3);

        /* @var PromiseInterface&MockObject $promise1 */
        $promise1 = $this->createMock(PromiseInterface::class);
        $promise1->expects($this->once())
                 ->method('then')
                 ->with(
                     $this->callback(function ($callback) use ($clientResponse, $response1) {
                         $this->assertIsCallable($callback);

                         $result = $callback($clientResponse);
                         $this->assertSame($response1, $result);
                         return true;
                     }),
                     $this->callback(function ($callback) use ($requestException) {
                         $this->assertIsCallable($callback);

                         $callback($requestException);
                         return true;
                     })
                 )
                 ->willReturn($promise2);

        $this->guzzleClient->expects($this->once())
                           ->method('sendAsync')
                           ->with($this->identicalTo($clientRequest))
                           ->willReturn($promise1);

        /* @var ApiClient&MockObject $apiClient */
        $apiClient = $this->getMockBuilder(ApiClient::class)
                          ->setMethods([
                              'createClientRequest',
                              'processResponse',
                              'processException',
                              'processApiClientException'
                          ])
                          ->setConstructorArgs([
                              $this->endpointService,
                              $this->guzzleClient,
                              $this->options,
                              $this->serializer
                          ])
                          ->getMock();
        $apiClient->expects($this->once())
                  ->method('createClientRequest')
                  ->with($this->identicalTo($request))
                  ->willReturn($clientRequest);
        $apiClient->expects($this->once())
                  ->method('processResponse')
                  ->with(
                      $this->identicalTo($request),
                      $this->identicalTo($clientRequest),
                      $this->identicalTo($clientResponse)
                  )
                  ->willReturn($response1);
        $apiClient->expects($this->once())
                  ->method('processException')
                  ->with($this->identicalTo($requestException));
        $apiClient->expects($this->once())
                  ->method('processApiClientException')
                  ->with($this->identicalTo($apiClientException), $this->identicalTo($request))
                  ->willReturn($response2);

        $result = $this->invokeMethod($apiClient, 'createPromiseForRequest', $request, true);

        $this->assertSame($promise3, $result);
    }


    /**
     * Tests the createPromiseForRequest method without setting the processApiException flag.
     * @throws ReflectionException
     * @covers ::createPromiseForRequest
     */
    public function testCreatePromiseForRequestWithoutProcessApiException(): void
    {
        /* @var RequestInterface&MockObject $request */
        $request = $this->createMock(RequestInterface::class);
        /* @var PsrRequestInterface&MockObject $clientRequest */
        $clientRequest = $this->createMock(PsrRequestInterface::class);
        /* @var RequestException&MockObject $requestException */
        $requestException = $this->createMock(RequestException::class);
        /* @var ResponseInterface&MockObject $response */
        $response = $this->createMock(ResponseInterface::class);
        /* @var PsrResponseInterface&MockObject $clientResponse */
        $clientResponse = $this->createMock(PsrResponseInterface::class);

        /* @var PromiseInterface&MockObject $promise2 */
        $promise2 = $this->createMock(PromiseInterface::class);

        /* @var PromiseInterface&MockObject $promise1 */
        $promise1 = $this->createMock(PromiseInterface::class);
        $promise1->expects($this->once())
                 ->method('then')
                 ->with(
                     $this->callback(function ($callback) use ($clientResponse, $response) {
                         $this->assertIsCallable($callback);

                         $result = $callback($clientResponse);
                         $this->assertSame($response, $result);
                         return true;
                     }),
                     $this->callback(function ($callback) use ($requestException) {
                         $this->assertIsCallable($callback);

                         $callback($requestException);
                         return true;
                     })
                 )
                 ->willReturn($promise2);

        $this->guzzleClient->expects($this->once())
                           ->method('sendAsync')
                           ->with($this->identicalTo($clientRequest))
                           ->willReturn($promise1);

        /* @var ApiClient&MockObject $apiClient */
        $apiClient = $this->getMockBuilder(ApiClient::class)
                          ->setMethods([
                              'createClientRequest',
                              'processResponse',
                              'processException',
                              'processApiClientException'
                          ])
                          ->setConstructorArgs([
                              $this->endpointService,
                              $this->guzzleClient,
                              $this->options,
                              $this->serializer
                          ])
                          ->getMock();
        $apiClient->expects($this->once())
                  ->method('createClientRequest')
                  ->with($this->identicalTo($request))
                  ->willReturn($clientRequest);
        $apiClient->expects($this->once())
                  ->method('processResponse')
                  ->with(
                      $this->identicalTo($request),
                      $this->identicalTo($clientRequest),
                      $this->identicalTo($clientResponse)
                  )
                  ->willReturn($response);
        $apiClient->expects($this->once())
                  ->method('processException')
                  ->with($this->identicalTo($requestException));
        $apiClient->expects($this->never())
                  ->method('processApiClientException');

        $result = $this->invokeMethod($apiClient, 'createPromiseForRequest', $request, false);

        $this->assertSame($promise2, $result);
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
     * Tests the processException method with a ConnectException.
     * @throws ReflectionException
     * @covers ::processException
     */
    public function testProcessExceptionWithConnectException(): void
    {
        $message = 'abc';
        $requestContents = 'def';

        /* @var PsrRequestInterface&MockObject $request */
        $request = $this->createMock(PsrRequestInterface::class);

        $exception = new ConnectException($message, $request);

        $this->expectExceptionObject(new ConnectionException($message, $requestContents, $exception));

        /* @var ApiClient&MockObject $apiClient */
        $apiClient = $this->getMockBuilder(ApiClient::class)
                          ->setMethods(['getContentsFromMessage'])
                          ->disableOriginalConstructor()
                          ->getMock();
        $apiClient->expects($this->exactly(2))
                  ->method('getContentsFromMessage')
                  ->withConsecutive(
                      [$this->identicalTo($request)],
                      [$this->isNull()]
                  )
                  ->willReturnOnConsecutiveCalls(
                      $requestContents,
                      ''
                  );

        $this->invokeMethod($apiClient, 'processException', $exception);
    }

    /**
     * Tests the processException method.
     * @throws ReflectionException
     * @covers ::processException
     */
    public function testProcessExceptionWithResponse(): void
    {
        $statusCode = 42;
        $exceptionMessage = 'abc';
        $message = 'def';
        $requestContents = 'ghi';
        $responseContents = 'jkl';

        /* @var PsrRequestInterface&MockObject $request */
        $request = $this->createMock(PsrRequestInterface::class);
        /* @var PsrResponseInterface&MockObject $response */
        $response = $this->createMock(PsrResponseInterface::class);
        $response->expects($this->atLeastOnce())
                 ->method('getStatusCode')
                 ->willReturn($statusCode);

        $exception = new RequestException($exceptionMessage, $request, $response);

        /* @var ApiClientException&MockObject $apiClientException */
        $apiClientException = $this->createMock(ApiClientException::class);

        $this->expectExceptionObject($apiClientException);

        /* @var ApiClient&MockObject $apiClient */
        $apiClient = $this->getMockBuilder(ApiClient::class)
                          ->setMethods([
                              'getContentsFromMessage',
                              'extractMessageFromErrorResponse',
                              'createApiClientException'
                          ])
                          ->disableOriginalConstructor()
                          ->getMock();
        $apiClient->expects($this->exactly(2))
                  ->method('getContentsFromMessage')
                  ->withConsecutive(
                      [$this->identicalTo($request)],
                      [$this->identicalTo($response)]
                  )
                  ->willReturnOnConsecutiveCalls(
                      $requestContents,
                      $responseContents
                  );
        $apiClient->expects($this->once())
                  ->method('extractMessageFromErrorResponse')
                  ->with($this->identicalTo($responseContents), $this->identicalTo($exceptionMessage))
                  ->willReturn($message);
        $apiClient->expects($this->once())
                   ->method('createApiClientException')
                   ->with(
                       $this->identicalTo($statusCode),
                       $this->identicalTo($message),
                       $this->identicalTo($requestContents),
                       $this->identicalTo($responseContents)
                   )
                   ->willReturn($apiClientException);

        $this->invokeMethod($apiClient, 'processException', $exception);
    }

    /**
     * Tests the processException method.
     * @throws ReflectionException
     * @covers ::processException
     */
    public function testProcessExceptionWithoutResponse(): void
    {
        $exceptionMessage = 'abc';
        $message = 'def';
        $requestContents = 'ghi';

        /* @var PsrRequestInterface&MockObject $request */
        $request = $this->createMock(PsrRequestInterface::class);

        $exception = new RequestException($exceptionMessage, $request);

        /* @var ApiClientException&MockObject $apiClientException */
        $apiClientException = $this->createMock(ApiClientException::class);

        $this->expectExceptionObject($apiClientException);

        /* @var ApiClient&MockObject $apiClient */
        $apiClient = $this->getMockBuilder(ApiClient::class)
                          ->setMethods([
                              'getContentsFromMessage',
                              'extractMessageFromErrorResponse',
                              'createApiClientException'
                          ])
                          ->disableOriginalConstructor()
                          ->getMock();
        $apiClient->expects($this->exactly(2))
                  ->method('getContentsFromMessage')
                  ->withConsecutive(
                      [$this->identicalTo($request)],
                      [$this->isNull()]
                  )
                  ->willReturnOnConsecutiveCalls(
                      $requestContents,
                      ''
                  );
        $apiClient->expects($this->once())
                  ->method('extractMessageFromErrorResponse')
                  ->with($this->identicalTo(''), $this->identicalTo($exceptionMessage))
                  ->willReturn($message);
        $apiClient->expects($this->once())
                   ->method('createApiClientException')
                   ->with(
                       $this->identicalTo(0),
                       $this->identicalTo($message),
                       $this->identicalTo($requestContents),
                       $this->identicalTo('')
                   )
                   ->willReturn($apiClientException);

        $this->invokeMethod($apiClient, 'processException', $exception);
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

    /**
     * Provides the data for the createApiClientException test.
     * @return array
     */
    public function provideCreateApiClientException(): array
    {
        return [
            [400, BadRequestException::class],
            [401, UnauthorizedException::class],
            [403, ForbiddenException::class],
            [404, NotFoundException::class],
            [500, ApiClientException::class],
            [0, ApiClientException::class],
        ];
    }

    /**
     * Tests the createApiClientException method.
     * @param int $statusCode
     * @param string $expectedClass
     * @throws ReflectionException
     * @covers ::createApiClientException
     * @dataProvider provideCreateApiClientException
     */
    public function testCreateApiClientException(int $statusCode, string $expectedClass): void
    {
        $apiClient = new ApiClient($this->endpointService, $this->guzzleClient, $this->options, $this->serializer);
        $result = $this->invokeMethod($apiClient, 'createApiClientException', $statusCode, 'abc', 'def', 'ghi');

        $this->assertInstanceOf($expectedClass, $result);
    }

    /**
     * Tests the processApiClientException method.
     * @throws ReflectionException
     * @covers ::processApiClientException
     */
    public function testProcessApiClientException(): void
    {
        /* @var UnauthorizedException&MockObject $exception */
        $exception = $this->createMock(UnauthorizedException::class);
        /* @var RequestInterface&MockObject $request */
        $request = $this->createMock(RequestInterface::class);
        /* @var ResponseInterface&MockObject $response */
        $response = $this->createMock(ResponseInterface::class);

        /* @var PromiseInterface&MockObject $promise */
        $promise = $this->createMock(PromiseInterface::class);
        $promise->expects($this->once())
                ->method('wait')
                ->willReturn($response);

        /* @var ApiClient&MockObject $apiClient */
        $apiClient = $this->getMockBuilder(ApiClient::class)
                          ->setMethods(['clearAuthorizationToken', 'createPromiseForRequest'])
                          ->disableOriginalConstructor()
                          ->getMock();
        $apiClient->expects($this->once())
                  ->method('clearAuthorizationToken');
        $apiClient->expects($this->once())
                  ->method('createPromiseForRequest')
                  ->with($this->identicalTo($request), $this->isFalse())
                  ->willReturn($promise);

        $result = $this->invokeMethod($apiClient, 'processApiClientException', $exception, $request);

        $this->assertSame($response, $result);
    }

    /**
     * Tests the processApiClientException method with a wrong exception.
     * @throws ReflectionException
     * @covers ::processApiClientException
     */
    public function testProcessApiClientExceptionWithWrongException(): void
    {
        /* @var UnauthorizedException&MockObject $exception */
        $exception = $this->createMock(ApiClientException::class);
        /* @var RequestInterface&MockObject $request */
        $request = $this->createMock(RequestInterface::class);

        $this->expectExceptionObject($exception);

        /* @var ApiClient&MockObject $apiClient */
        $apiClient = $this->getMockBuilder(ApiClient::class)
                          ->setMethods(['createPromiseForRequest'])
                          ->disableOriginalConstructor()
                          ->getMock();
        $apiClient->expects($this->never())
                  ->method('createPromiseForRequest');

        $this->invokeMethod($apiClient, 'processApiClientException', $exception, $request);
    }
}

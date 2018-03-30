<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Client;

use BluePsyduck\MultiCurl\Constant\RequestMethod;
use BluePsyduck\MultiCurl\Entity\Header;
use BluePsyduck\MultiCurl\Entity\Request;
use BluePsyduck\MultiCurl\MultiCurlManager;
use FactorioItemBrowser\Api\Client\Client\Client;
use FactorioItemBrowser\Api\Client\Client\Options;
use FactorioItemBrowser\Api\Client\Exception\ApiClientException;
use FactorioItemBrowser\Api\Client\Exception\BadRequestException;
use FactorioItemBrowser\Api\Client\Exception\TimeoutException;
use FactorioItemBrowser\Api\Client\Request\Auth\AuthRequest;
use FactorioItemBrowser\Api\Client\Response\Auth\AuthResponse;
use FactorioItemBrowserTestAsset\Api\Client\Request\TestRequest;
use FactorioItemBrowserTestAsset\Api\Client\Response\TestPendingResponse;
use FactorioItemBrowserTestAsset\Api\Client\Response\TestResponse;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the client class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Client\Client
 */
class ClientTest extends TestCase
{
    /**
     * Tests setting the locale.
     * @covers ::setLocale
     */
    public function testSetLocale()
    {
        $client = new Client(new Options());
        $this->assertEquals($client, $client->setLocale('abc'));
    }

    /**
     * Tests setting the enabledModNames.
     * @covers ::setEnabledModNames
     */
    public function testSetEnabledModNames()
    {
        $client = new Client(new Options());
        $this->assertEquals($client, $client->setEnabledModNames(['abc', 'def']));
    }

    /**
     * Tests setting and getting the authorization token.
     * @covers ::setAuthorizationToken
     * @covers ::getAuthorizationToken
     */
    public function testSetAndGetAuthorizationToken()
    {
        $authorizationToken = 'abc';

        $client = new Client(new Options());
        $this->assertEquals($client, $client->setAuthorizationToken($authorizationToken));
        $this->assertEquals($authorizationToken, $client->getAuthorizationToken());
    }

    /**
     * Tests sending and creating the request.
     * @covers ::send
     * @covers ::createRequest
     *
     */
    public function testSendAndCreateRequest()
    {
        $options = new Options();
        $options->setTimeout(42)
                ->setApiUrl('abc');

        $request = new TestRequest('/def', ['ghi' => 'jkl']);

        /* @var Client|MockObject $client */
        $client = $this->getMockBuilder(Client::class)
                       ->setMethods(['requestAuthorizationToken', 'executeRequest'])
                       ->setConstructorArgs([$options])
                       ->getMock();
        $client->expects($this->once())
               ->method('requestAuthorizationToken');
        $client->expects($this->once())
               ->method('executeRequest')
               ->with($this->callback(function (Request $request): bool {
                   return $request->getMethod() === RequestMethod::POST
                       && $request->getUrl() === 'abc/def'
                       && $request->getTimeout() === 42
                       && $request->getRequestData() === '{"ghi":"jkl"}'
                       && $request->getHeader()->get('Content-Type') === 'application/json'
                       && $request->getHeader()->get('Accept-Language') === 'mno';
               }));
        $client->setLocale('mno');

        $response = $client->send($request);
        $this->assertInstanceOf(TestResponse::class, $response);
    }

    /**
     * Provides the data for the executeRequest test.
     * @return array
     */
    public function provideExecuteRequest(): array
    {
        return [
            ['', false],
            ['abc', true]
        ];
    }

    /**
     * Tests executing the request.
     * @param string $authorizationToken
     * @param bool $expectHeaderSet
     * @covers ::executeRequest
     * @dataProvider provideExecuteRequest
     */
    public function testExecuteRequest(string $authorizationToken, bool $expectHeaderSet)
    {
        if ($expectHeaderSet) {
            /* @var Header|MockObject $header */
            $header = $this->getMockBuilder(Header::class)
                           ->setMethods(['set'])
                           ->getMock();
            $header->expects($this->once())
                   ->method('set')
                   ->with('Authorization', 'Bearer ' . $authorizationToken);

            /* @var Request|MockObject $request */
            $request = $this->getMockBuilder(Request::class)
                            ->setMethods(['getHeader'])
                            ->getMock();
            $request->expects($this->once())
                    ->method('getHeader')
                    ->willReturn($header);
        } else {
            $request = new Request();
        }
        $request->setMethod('abc');

        /* @var MultiCurlManager|MockObject $multiCurlManager */
        $multiCurlManager = $this->getMockBuilder(MultiCurlManager::class)
                                 ->setMethods(['addRequest'])
                                 ->getMock();
        $multiCurlManager->expects($this->once())
                         ->method('addRequest')
                         ->with($request);

        $client = new Client(new Options(), $multiCurlManager);
        $client->setAuthorizationToken($authorizationToken);
        $this->assertEquals($client, $client->executeRequest($request));
    }

    /**
     * The data provider of the fetchResponse test.
     * @return array
     */
    public function provideFetchResponse(): array
    {
        $request1 = new Request();
        $request1->getResponse()->setStatusCode(200)
                                ->setErrorCode(CURLE_OK)
                                ->setContent('{"abc":"def"}');

        $request2 = new Request();
        $request2->getResponse()->setErrorCode(CURLE_OPERATION_TIMEDOUT);

        $request3 = new Request();
        $request3->getResponse()->setErrorCode(CURLE_COULDNT_CONNECT);

        $request4 = new Request();
        $request4->getResponse()->setStatusCode(200)
                                ->setErrorCode(CURLE_OK)
                                ->setContent('foo');

        $request5 = new Request();
        $request5->getResponse()->setStatusCode(400)
                                ->setErrorCode(CURLE_OK)
                                ->setContent('{"abc":"def"}');

        return [
            [$request1, '', '', ['abc' => 'def']],
            [$request2, TimeoutException::class, 'Requested timed out.', []],
            [$request3, ApiClientException::class, 'Request failed', []],
            [$request4, ApiClientException::class, 'Response was not a valid JSON string.', []],
            [$request5, BadRequestException::class, '', []]
        ];
    }

    /**
     * Tests fetching the response.
     * @param Request $request
     * @param string $expectedException
     * @param string $expectedExceptionMessage
     * @param array $expectedResult
     * @throws ApiClientException
     * @covers ::__construct
     * @covers ::fetchResponse
     * @dataProvider provideFetchResponse
     */
    public function testFetchResponse(
        Request $request,
        string $expectedException,
        string $expectedExceptionMessage,
        array $expectedResult
    )
    {
        /* @var MultiCurlManager|MockObject $multiCurlManager */
        $multiCurlManager = $this->getMockBuilder(MultiCurlManager::class)
                                 ->setMethods(['waitForSingleRequest'])
                                 ->getMock();
        $multiCurlManager->expects($this->once())
                         ->method('waitForSingleRequest')
                         ->with($request);

        if (strlen($expectedException) > 0) {
            $this->expectException($expectedException);
            $this->expectExceptionMessage($expectedExceptionMessage);
        }

        $client = new Client(new Options(), $multiCurlManager);
        $result = $client->fetchResponse($request);
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * Tests requesting the authorization token.
     * @covers ::__construct
     * @covers ::requestAuthorizationToken
     */
    public function testRequestAuthorizationToken()
    {
        $options = new Options();
        $options->setAgent('abc')
                ->setAccessKey('def');

        $expectedRequest = new AuthRequest();
        $expectedRequest->setAgent('abc')
                        ->setAccessKey('def')
                        ->setEnabledModNames(['ghi', 'jkl']);

        $expectedToken = 'mno';

        $response = new AuthResponse(new TestPendingResponse(['authorizationToken' => $expectedToken]));

        /* @var Client|MockObject $client */
        $client = $this->getMockBuilder(Client::class)
                       ->setMethods(['send'])
                       ->setConstructorArgs([$options])
                       ->getMock();
        $client->expects($this->once())
               ->method('send')
               ->with($expectedRequest)
               ->willReturn($response);
        $client->setEnabledModNames(['ghi', 'jkl']);

        $client->requestAuthorizationToken();
        $this->assertEquals($expectedToken, $client->getAuthorizationToken());
    }
}

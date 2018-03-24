<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Request\Auth;

use FactorioItemBrowser\Api\Client\Request\Auth\AuthRequest;
use FactorioItemBrowser\Api\Client\Response\Auth\AuthResponse;
use FactorioItemBrowserTestAsset\Api\Client\Response\TestPendingResponse;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the auth request class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass FactorioItemBrowser\Api\Client\Request\Auth\AuthRequest
 */
class AuthRequestTest extends TestCase
{
    /**
     * Tests getting the request path.
     * @covers ::getRequestPath
     */
    public function testGetRequestPath()
    {
        $request = new AuthRequest();
        $this->assertEquals('/auth', $request->getRequestPath());
    }

    /**
     * Tests getting the request data.
     * @covers ::getRequestData
     * @covers ::setAgent
     * @covers ::setAccessKey
     * @covers ::setEnabledModNames
     */
    public function testGetRequestData()
    {
        $request = new AuthRequest();
        $this->assertEquals($request, $request->setAgent('abc'));
        $this->assertEquals($request, $request->setAccessKey('def'));
        $this->assertEquals($request, $request->setEnabledModNames(['ghi', 'jkl']));

        $expectedData = [
            'agent' => 'abc',
            'accessKey' => 'def',
            'enabledModNames' => ['ghi', 'jkl']
        ];
        $this->assertEquals($expectedData, $request->getRequestData());
    }

    /**
     * Tests creating the response.
     * @covers ::createResponse
     */
    public function testCreateResponse()
    {
        $request = new AuthRequest();
        $this->assertInstanceOf(AuthResponse::class, $request->createResponse(new TestPendingResponse()));
    }
}

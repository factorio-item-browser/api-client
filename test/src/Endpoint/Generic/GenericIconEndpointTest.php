<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Endpoint\Generic;

use FactorioItemBrowser\Api\Client\Endpoint\Generic\GenericIconEndpoint;
use FactorioItemBrowser\Api\Client\Request\Generic\GenericIconRequest;
use FactorioItemBrowser\Api\Client\Response\Generic\GenericIconResponse;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the GenericIconEndpoint class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Endpoint\Generic\GenericIconEndpoint
 */
class GenericIconEndpointTest extends TestCase
{
    /**
     * Tests the getSupportedRequestClass method.
     * @covers ::getSupportedRequestClass
     */
    public function testGetSupportedRequestClass(): void
    {
        $endpoint = new GenericIconEndpoint();
        $result = $endpoint->getSupportedRequestClass();

        $this->assertSame(GenericIconRequest::class, $result);
    }

    /**
     * Tests the requiresAuthorizationToken method.
     * @covers ::requiresAuthorizationToken
     */
    public function testRequiresAuthorizationToken(): void
    {
        $endpoint = new GenericIconEndpoint();
        $result = $endpoint->requiresAuthorizationToken();

        $this->assertTrue($result);
    }

    /**
     * Tests the getRequestPath method.
     * @covers ::getRequestPath
     */
    public function testGetRequestPath(): void
    {
        $endpoint = new GenericIconEndpoint();
        $result = $endpoint->getRequestPath();

        $this->assertSame('generic/icon', $result);
    }

    /**
     * Tests the getResponseClass method.
     * @covers ::getResponseClass
     */
    public function testGetResponseClass(): void
    {
        $endpoint = new GenericIconEndpoint();
        $result = $endpoint->getResponseClass();

        $this->assertSame(GenericIconResponse::class, $result);
    }
}

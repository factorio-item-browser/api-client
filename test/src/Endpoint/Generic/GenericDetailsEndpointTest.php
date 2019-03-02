<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Endpoint\Generic;

use FactorioItemBrowser\Api\Client\Endpoint\Generic\GenericDetailsEndpoint;
use FactorioItemBrowser\Api\Client\Request\Generic\GenericDetailsRequest;
use FactorioItemBrowser\Api\Client\Response\Generic\GenericDetailsResponse;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the GenericDetailsEndpoint class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Endpoint\Generic\GenericDetailsEndpoint
 */
class GenericDetailsEndpointTest extends TestCase
{
    /**
     * Tests the getSupportedRequestClass method.
     * @covers ::getSupportedRequestClass
     */
    public function testGetSupportedRequestClass(): void
    {
        $endpoint = new GenericDetailsEndpoint();
        $result = $endpoint->getSupportedRequestClass();

        $this->assertSame(GenericDetailsRequest::class, $result);
    }

    /**
     * Tests the requiresAuthorizationToken method.
     * @covers ::requiresAuthorizationToken
     */
    public function testRequiresAuthorizationToken(): void
    {
        $endpoint = new GenericDetailsEndpoint();
        $result = $endpoint->requiresAuthorizationToken();

        $this->assertTrue($result);
    }

    /**
     * Tests the getRequestPath method.
     * @covers ::getRequestPath
     */
    public function testGetRequestPath(): void
    {
        $endpoint = new GenericDetailsEndpoint();
        $result = $endpoint->getRequestPath();

        $this->assertSame('generic/details', $result);
    }

    /**
     * Tests the getResponseClass method.
     * @covers ::getResponseClass
     */
    public function testGetResponseClass(): void
    {
        $endpoint = new GenericDetailsEndpoint();
        $result = $endpoint->getResponseClass();

        $this->assertSame(GenericDetailsResponse::class, $result);
    }
}

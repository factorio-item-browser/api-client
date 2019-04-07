<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Endpoint\Item;

use FactorioItemBrowser\Api\Client\Endpoint\Item\ItemRandomEndpoint;
use FactorioItemBrowser\Api\Client\Request\Item\ItemRandomRequest;
use FactorioItemBrowser\Api\Client\Response\Item\ItemRandomResponse;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the ItemRandomEndpoint class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Endpoint\Item\ItemRandomEndpoint
 */
class ItemRandomEndpointTest extends TestCase
{
    /**
     * Tests the getSupportedRequestClass method.
     * @covers ::getSupportedRequestClass
     */
    public function testGetSupportedRequestClass(): void
    {
        $endpoint = new ItemRandomEndpoint();
        $result = $endpoint->getSupportedRequestClass();

        $this->assertSame(ItemRandomRequest::class, $result);
    }

    /**
     * Tests the requiresAuthorizationToken method.
     * @covers ::requiresAuthorizationToken
     */
    public function testRequiresAuthorizationToken(): void
    {
        $endpoint = new ItemRandomEndpoint();
        $result = $endpoint->requiresAuthorizationToken();

        $this->assertTrue($result);
    }

    /**
     * Tests the getRequestPath method.
     * @covers ::getRequestPath
     */
    public function testGetRequestPath(): void
    {
        $endpoint = new ItemRandomEndpoint();
        $result = $endpoint->getRequestPath();

        $this->assertSame('item/random', $result);
    }

    /**
     * Tests the getResponseClass method.
     * @covers ::getResponseClass
     */
    public function testGetResponseClass(): void
    {
        $endpoint = new ItemRandomEndpoint();
        $result = $endpoint->getResponseClass();

        $this->assertSame(ItemRandomResponse::class, $result);
    }
}

<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Endpoint\Item;

use FactorioItemBrowser\Api\Client\Endpoint\Item\ItemProductEndpoint;
use FactorioItemBrowser\Api\Client\Request\Item\ItemProductRequest;
use FactorioItemBrowser\Api\Client\Response\Item\ItemProductResponse;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the ItemProductEndpoint class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Endpoint\Item\ItemProductEndpoint
 */
class ItemProductEndpointTest extends TestCase
{
    /**
     * Tests the getSupportedRequestClass method.
     * @covers ::getSupportedRequestClass
     */
    public function testGetSupportedRequestClass(): void
    {
        $endpoint = new ItemProductEndpoint();
        $result = $endpoint->getSupportedRequestClass();

        $this->assertSame(ItemProductRequest::class, $result);
    }

    /**
     * Tests the requiresAuthorizationToken method.
     * @covers ::requiresAuthorizationToken
     */
    public function testRequiresAuthorizationToken(): void
    {
        $endpoint = new ItemProductEndpoint();
        $result = $endpoint->requiresAuthorizationToken();

        $this->assertTrue($result);
    }

    /**
     * Tests the getRequestPath method.
     * @covers ::getRequestPath
     */
    public function testGetRequestPath(): void
    {
        $endpoint = new ItemProductEndpoint();
        $result = $endpoint->getRequestPath();

        $this->assertSame('item/product', $result);
    }

    /**
     * Tests the getResponseClass method.
     * @covers ::getResponseClass
     */
    public function testGetResponseClass(): void
    {
        $endpoint = new ItemProductEndpoint();
        $result = $endpoint->getResponseClass();

        $this->assertSame(ItemProductResponse::class, $result);
    }
}

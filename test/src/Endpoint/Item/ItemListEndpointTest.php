<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Endpoint\Item;

use FactorioItemBrowser\Api\Client\Endpoint\Item\ItemListEndpoint;
use FactorioItemBrowser\Api\Client\Request\Item\ItemListRequest;
use FactorioItemBrowser\Api\Client\Response\Item\ItemListResponse;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the ItemListEndpoint class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Endpoint\Item\ItemListEndpoint
 */
class ItemListEndpointTest extends TestCase
{
    /**
     * Tests the getSupportedRequestClass method.
     * @covers ::getSupportedRequestClass
     */
    public function testGetSupportedRequestClass(): void
    {
        $endpoint = new ItemListEndpoint();
        $result = $endpoint->getSupportedRequestClass();

        $this->assertSame(ItemListRequest::class, $result);
    }

    /**
     * Tests the requiresAuthorizationToken method.
     * @covers ::requiresAuthorizationToken
     */
    public function testRequiresAuthorizationToken(): void
    {
        $endpoint = new ItemListEndpoint();
        $result = $endpoint->requiresAuthorizationToken();

        $this->assertTrue($result);
    }

    /**
     * Tests the getRequestPath method.
     * @covers ::getRequestPath
     */
    public function testGetRequestPath(): void
    {
        $endpoint = new ItemListEndpoint();
        $result = $endpoint->getRequestPath();

        $this->assertSame('item/list', $result);
    }

    /**
     * Tests the getResponseClass method.
     * @covers ::getResponseClass
     */
    public function testGetResponseClass(): void
    {
        $endpoint = new ItemListEndpoint();
        $result = $endpoint->getResponseClass();

        $this->assertSame(ItemListResponse::class, $result);
    }
}

<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Endpoint\Recipe;

use FactorioItemBrowser\Api\Client\Endpoint\Recipe\RecipeListEndpoint;
use FactorioItemBrowser\Api\Client\Request\Recipe\RecipeListRequest;
use FactorioItemBrowser\Api\Client\Response\Recipe\RecipeListResponse;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the RecipeListEndpoint class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Endpoint\Recipe\RecipeListEndpoint
 */
class RecipeListEndpointTest extends TestCase
{
    /**
     * Tests the getSupportedRequestClass method.
     * @covers ::getSupportedRequestClass
     */
    public function testGetSupportedRequestClass(): void
    {
        $endpoint = new RecipeListEndpoint();
        $result = $endpoint->getSupportedRequestClass();

        $this->assertSame(RecipeListRequest::class, $result);
    }

    /**
     * Tests the requiresAuthorizationToken method.
     * @covers ::requiresAuthorizationToken
     */
    public function testRequiresAuthorizationToken(): void
    {
        $endpoint = new RecipeListEndpoint();
        $result = $endpoint->requiresAuthorizationToken();

        $this->assertTrue($result);
    }

    /**
     * Tests the getRequestPath method.
     * @covers ::getRequestPath
     */
    public function testGetRequestPath(): void
    {
        $endpoint = new RecipeListEndpoint();
        $result = $endpoint->getRequestPath();

        $this->assertSame('recipe/list', $result);
    }

    /**
     * Tests the getResponseClass method.
     * @covers ::getResponseClass
     */
    public function testGetResponseClass(): void
    {
        $endpoint = new RecipeListEndpoint();
        $result = $endpoint->getResponseClass();

        $this->assertSame(RecipeListResponse::class, $result);
    }
}

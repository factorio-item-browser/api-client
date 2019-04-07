<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Endpoint\Recipe;

use FactorioItemBrowser\Api\Client\Endpoint\Recipe\RecipeDetailsEndpoint;
use FactorioItemBrowser\Api\Client\Request\Recipe\RecipeDetailsRequest;
use FactorioItemBrowser\Api\Client\Response\Recipe\RecipeDetailsResponse;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the RecipeDetailsEndpoint class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Endpoint\Recipe\RecipeDetailsEndpoint
 */
class RecipeDetailsEndpointTest extends TestCase
{
    /**
     * Tests the getSupportedRequestClass method.
     * @covers ::getSupportedRequestClass
     */
    public function testGetSupportedRequestClass(): void
    {
        $endpoint = new RecipeDetailsEndpoint();
        $result = $endpoint->getSupportedRequestClass();

        $this->assertSame(RecipeDetailsRequest::class, $result);
    }

    /**
     * Tests the requiresAuthorizationToken method.
     * @covers ::requiresAuthorizationToken
     */
    public function testRequiresAuthorizationToken(): void
    {
        $endpoint = new RecipeDetailsEndpoint();
        $result = $endpoint->requiresAuthorizationToken();

        $this->assertTrue($result);
    }

    /**
     * Tests the getRequestPath method.
     * @covers ::getRequestPath
     */
    public function testGetRequestPath(): void
    {
        $endpoint = new RecipeDetailsEndpoint();
        $result = $endpoint->getRequestPath();

        $this->assertSame('recipe/details', $result);
    }

    /**
     * Tests the getResponseClass method.
     * @covers ::getResponseClass
     */
    public function testGetResponseClass(): void
    {
        $endpoint = new RecipeDetailsEndpoint();
        $result = $endpoint->getResponseClass();

        $this->assertSame(RecipeDetailsResponse::class, $result);
    }
}

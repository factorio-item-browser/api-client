<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Endpoint\Recipe;

use FactorioItemBrowser\Api\Client\Endpoint\Recipe\RecipeMachinesEndpoint;
use FactorioItemBrowser\Api\Client\Request\Recipe\RecipeMachinesRequest;
use FactorioItemBrowser\Api\Client\Response\Recipe\RecipeMachinesResponse;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the RecipeMachinesEndpoint class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Endpoint\Recipe\RecipeMachinesEndpoint
 */
class RecipeMachinesEndpointTest extends TestCase
{
    /**
     * Tests the getSupportedRequestClass method.
     * @covers ::getSupportedRequestClass
     */
    public function testGetSupportedRequestClass(): void
    {
        $endpoint = new RecipeMachinesEndpoint();
        $result = $endpoint->getSupportedRequestClass();

        $this->assertSame(RecipeMachinesRequest::class, $result);
    }

    /**
     * Tests the requiresAuthorizationToken method.
     * @covers ::requiresAuthorizationToken
     */
    public function testRequiresAuthorizationToken(): void
    {
        $endpoint = new RecipeMachinesEndpoint();
        $result = $endpoint->requiresAuthorizationToken();

        $this->assertTrue($result);
    }

    /**
     * Tests the getRequestPath method.
     * @covers ::getRequestPath
     */
    public function testGetRequestPath(): void
    {
        $endpoint = new RecipeMachinesEndpoint();
        $result = $endpoint->getRequestPath();

        $this->assertSame('recipe/machines', $result);
    }

    /**
     * Tests the getResponseClass method.
     * @covers ::getResponseClass
     */
    public function testGetResponseClass(): void
    {
        $endpoint = new RecipeMachinesEndpoint();
        $result = $endpoint->getResponseClass();

        $this->assertSame(RecipeMachinesResponse::class, $result);
    }
}

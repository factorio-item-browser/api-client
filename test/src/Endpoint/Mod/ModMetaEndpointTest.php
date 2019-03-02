<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Endpoint\Mod;

use FactorioItemBrowser\Api\Client\Endpoint\Mod\ModMetaEndpoint;
use FactorioItemBrowser\Api\Client\Request\Mod\ModMetaRequest;
use FactorioItemBrowser\Api\Client\Response\Mod\ModMetaResponse;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the ModMetaEndpoint class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Endpoint\Mod\ModMetaEndpoint
 */
class ModMetaEndpointTest extends TestCase
{
    /**
     * Tests the getSupportedRequestClass method.
     * @covers ::getSupportedRequestClass
     */
    public function testGetSupportedRequestClass(): void
    {
        $endpoint = new ModMetaEndpoint();
        $result = $endpoint->getSupportedRequestClass();

        $this->assertSame(ModMetaRequest::class, $result);
    }

    /**
     * Tests the requiresAuthorizationToken method.
     * @covers ::requiresAuthorizationToken
     */
    public function testRequiresAuthorizationToken(): void
    {
        $endpoint = new ModMetaEndpoint();
        $result = $endpoint->requiresAuthorizationToken();

        $this->assertTrue($result);
    }

    /**
     * Tests the getRequestPath method.
     * @covers ::getRequestPath
     */
    public function testGetRequestPath(): void
    {
        $endpoint = new ModMetaEndpoint();
        $result = $endpoint->getRequestPath();

        $this->assertSame('mod/meta', $result);
    }

    /**
     * Tests the getResponseClass method.
     * @covers ::getResponseClass
     */
    public function testGetResponseClass(): void
    {
        $endpoint = new ModMetaEndpoint();
        $result = $endpoint->getResponseClass();

        $this->assertSame(ModMetaResponse::class, $result);
    }
}

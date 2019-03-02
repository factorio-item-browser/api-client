<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Endpoint\Auth;

use FactorioItemBrowser\Api\Client\Endpoint\Auth\AuthEndpoint;
use FactorioItemBrowser\Api\Client\Request\Auth\AuthRequest;
use FactorioItemBrowser\Api\Client\Response\Auth\AuthResponse;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the AuthEndpoint class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Endpoint\Auth\AuthEndpoint
 */
class AuthEndpointTest extends TestCase
{
    /**
     * Tests the getSupportedRequestClass method.
     * @covers ::getSupportedRequestClass
     */
    public function testGetSupportedRequestClass(): void
    {
        $endpoint = new AuthEndpoint();
        $result = $endpoint->getSupportedRequestClass();

        $this->assertSame(AuthRequest::class, $result);
    }

    /**
     * Tests the requiresAuthorizationToken method.
     * @covers ::requiresAuthorizationToken
     */
    public function testRequiresAuthorizationToken(): void
    {
        $endpoint = new AuthEndpoint();
        $result = $endpoint->requiresAuthorizationToken();

        $this->assertFalse($result);
    }

    /**
     * Tests the getRequestPath method.
     * @covers ::getRequestPath
     */
    public function testGetRequestPath(): void
    {
        $endpoint = new AuthEndpoint();
        $result = $endpoint->getRequestPath();

        $this->assertSame('auth', $result);
    }

    /**
     * Tests the getResponseClass method.
     * @covers ::getResponseClass
     */
    public function testGetResponseClass(): void
    {
        $endpoint = new AuthEndpoint();
        $result = $endpoint->getResponseClass();

        $this->assertSame(AuthResponse::class, $result);
    }
}

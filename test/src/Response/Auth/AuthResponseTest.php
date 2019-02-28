<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Response\Auth;

use FactorioItemBrowser\Api\Client\Response\Auth\AuthResponse;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the auth response class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Response\Auth\AuthResponse
 */
class AuthResponseTest extends TestCase
{
    /**
     * Tests the constructing.
     * @coversNothing
     */
    public function testConstruct(): void
    {
        $response = new AuthResponse();

        $this->assertSame('', $response->getAuthorizationToken());
    }

    /**
     * Tests the setting and getting the authorization token.
     * @covers ::getAuthorizationToken
     * @covers ::setAuthorizationToken
     */
    public function testSetAndGetAuthorizationToken(): void
    {
        $authorizationToken = 'abc';
        $response = new AuthResponse();

        $this->assertSame($response, $response->setAuthorizationToken($authorizationToken));
        $this->assertSame($authorizationToken, $response->getAuthorizationToken());
    }
}

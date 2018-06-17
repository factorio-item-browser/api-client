<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Response\Auth;

use FactorioItemBrowser\Api\Client\Response\Auth\AuthResponse;
use FactorioItemBrowserTestAsset\Api\Client\Response\TestPendingResponse;
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
     * Tests mapping and getting the authorization token.
     * @covers ::getAuthorizationToken
     * @covers ::mapResponse
     */
    public function testGetAuthorizationToken()
    {
        $responseData = [
            'authorizationToken' => 'abc'
        ];

        $response = new AuthResponse(new TestPendingResponse($responseData));
        $this->assertEquals('abc', $response->getAuthorizationToken());
    }
}

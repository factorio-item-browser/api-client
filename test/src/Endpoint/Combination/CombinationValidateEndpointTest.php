<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Endpoint\Combination;

use FactorioItemBrowser\Api\Client\Endpoint\Combination\CombinationValidateEndpoint;
use FactorioItemBrowser\Api\Client\Request\Combination\CombinationValidateRequest;
use FactorioItemBrowser\Api\Client\Response\Combination\CombinationValidateResponse;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the CombinationValidateEndpoint class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Endpoint\Combination\CombinationValidateEndpoint
 */
class CombinationValidateEndpointTest extends TestCase
{
/**
     * Tests the getSupportedRequestClass method.
     * @covers ::getSupportedRequestClass
     */
    public function testGetSupportedRequestClass(): void
    {
        $endpoint = new CombinationValidateEndpoint();
        $result = $endpoint->getSupportedRequestClass();

        $this->assertSame(CombinationValidateRequest::class, $result);
    }

    /**
     * Tests the requiresAuthorizationToken method.
     * @covers ::requiresAuthorizationToken
     */
    public function testRequiresAuthorizationToken(): void
    {
        $endpoint = new CombinationValidateEndpoint();
        $result = $endpoint->requiresAuthorizationToken();

        $this->assertTrue($result);
    }

    /**
     * Tests the getRequestPath method.
     * @covers ::getRequestPath
     */
    public function testGetRequestPath(): void
    {
        $endpoint = new CombinationValidateEndpoint();
        $result = $endpoint->getRequestPath();

        $this->assertSame('combination/validate', $result);
    }

    /**
     * Tests the getResponseClass method.
     * @covers ::getResponseClass
     */
    public function testGetResponseClass(): void
    {
        $endpoint = new CombinationValidateEndpoint();
        $result = $endpoint->getResponseClass();

        $this->assertSame(CombinationValidateResponse::class, $result);
    }
}

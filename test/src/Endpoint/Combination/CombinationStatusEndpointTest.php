<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Endpoint\Combination;

use FactorioItemBrowser\Api\Client\Endpoint\Combination\CombinationStatusEndpoint;
use FactorioItemBrowser\Api\Client\Request\Combination\CombinationStatusRequest;
use FactorioItemBrowser\Api\Client\Response\Combination\CombinationStatusResponse;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the CombinationStatusEndpoint class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Endpoint\Combination\CombinationStatusEndpoint
 */
class CombinationStatusEndpointTest extends TestCase
{
    /**
     * Tests the getSupportedRequestClass method.
     * @covers ::getSupportedRequestClass
     */
    public function testGetSupportedRequestClass(): void
    {
        $endpoint = new CombinationStatusEndpoint();
        $result = $endpoint->getSupportedRequestClass();

        $this->assertSame(CombinationStatusRequest::class, $result);
    }

    /**
     * Tests the requiresAuthorizationToken method.
     * @covers ::requiresAuthorizationToken
     */
    public function testRequiresAuthorizationToken(): void
    {
        $endpoint = new CombinationStatusEndpoint();
        $result = $endpoint->requiresAuthorizationToken();

        $this->assertTrue($result);
    }

    /**
     * Tests the getRequestPath method.
     * @covers ::getRequestPath
     */
    public function testGetRequestPath(): void
    {
        $endpoint = new CombinationStatusEndpoint();
        $result = $endpoint->getRequestPath();

        $this->assertSame('combination/status', $result);
    }

    /**
     * Tests the getResponseClass method.
     * @covers ::getResponseClass
     */
    public function testGetResponseClass(): void
    {
        $endpoint = new CombinationStatusEndpoint();
        $result = $endpoint->getResponseClass();

        $this->assertSame(CombinationStatusResponse::class, $result);
    }
}

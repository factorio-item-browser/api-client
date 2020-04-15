<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Endpoint\Combination;

use FactorioItemBrowser\Api\Client\Endpoint\Combination\CombinationExportEndpoint;
use FactorioItemBrowser\Api\Client\Request\Combination\CombinationExportRequest;
use FactorioItemBrowser\Api\Client\Response\Combination\CombinationStatusResponse;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the CombinationExportEndpoint class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Endpoint\Combination\CombinationExportEndpoint
 */
class CombinationExportEndpointTest extends TestCase
{
    /**
     * Tests the getSupportedRequestClass method.
     * @covers ::getSupportedRequestClass
     */
    public function testGetSupportedRequestClass(): void
    {
        $endpoint = new CombinationExportEndpoint();
        $result = $endpoint->getSupportedRequestClass();

        $this->assertSame(CombinationExportRequest::class, $result);
    }

    /**
     * Tests the requiresAuthorizationToken method.
     * @covers ::requiresAuthorizationToken
     */
    public function testRequiresAuthorizationToken(): void
    {
        $endpoint = new CombinationExportEndpoint();
        $result = $endpoint->requiresAuthorizationToken();

        $this->assertTrue($result);
    }

    /**
     * Tests the getRequestPath method.
     * @covers ::getRequestPath
     */
    public function testGetRequestPath(): void
    {
        $endpoint = new CombinationExportEndpoint();
        $result = $endpoint->getRequestPath();

        $this->assertSame('combination/export', $result);
    }

    /**
     * Tests the getResponseClass method.
     * @covers ::getResponseClass
     */
    public function testGetResponseClass(): void
    {
        $endpoint = new CombinationExportEndpoint();
        $result = $endpoint->getResponseClass();

        $this->assertSame(CombinationStatusResponse::class, $result);
    }
}

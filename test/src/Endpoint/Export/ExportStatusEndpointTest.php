<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Endpoint\Export;

use FactorioItemBrowser\Api\Client\Endpoint\Export\ExportStatusEndpoint;
use FactorioItemBrowser\Api\Client\Request\Export\ExportStatusRequest;
use FactorioItemBrowser\Api\Client\Response\Export\ExportStatusResponse;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the ExportStatusEndpoint class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Endpoint\Export\ExportStatusEndpoint
 */
class ExportStatusEndpointTest extends TestCase
{
    /**
     * Tests the getSupportedRequestClass method.
     * @covers ::getSupportedRequestClass
     */
    public function testGetSupportedRequestClass(): void
    {
        $endpoint = new ExportStatusEndpoint();
        $result = $endpoint->getSupportedRequestClass();

        $this->assertSame(ExportStatusRequest::class, $result);
    }

    /**
     * Tests the requiresAuthorizationToken method.
     * @covers ::requiresAuthorizationToken
     */
    public function testRequiresAuthorizationToken(): void
    {
        $endpoint = new ExportStatusEndpoint();
        $result = $endpoint->requiresAuthorizationToken();

        $this->assertTrue($result);
    }

    /**
     * Tests the getRequestPath method.
     * @covers ::getRequestPath
     */
    public function testGetRequestPath(): void
    {
        $endpoint = new ExportStatusEndpoint();
        $result = $endpoint->getRequestPath();

        $this->assertSame('export/status', $result);
    }

    /**
     * Tests the getResponseClass method.
     * @covers ::getResponseClass
     */
    public function testGetResponseClass(): void
    {
        $endpoint = new ExportStatusEndpoint();
        $result = $endpoint->getResponseClass();

        $this->assertSame(ExportStatusResponse::class, $result);
    }
}

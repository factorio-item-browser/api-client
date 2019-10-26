<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Endpoint\Export;

use FactorioItemBrowser\Api\Client\Endpoint\Export\ExportCreateEndpoint;
use FactorioItemBrowser\Api\Client\Request\Export\ExportCreateRequest;
use FactorioItemBrowser\Api\Client\Response\Export\ExportCreateResponse;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the ExportCreateEndpoint class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Endpoint\Export\ExportCreateEndpoint
 */
class ExportCreateEndpointTest extends TestCase
{
    /**
     * Tests the getSupportedRequestClass method.
     * @covers ::getSupportedRequestClass
     */
    public function testGetSupportedRequestClass(): void
    {
        $endpoint = new ExportCreateEndpoint();
        $result = $endpoint->getSupportedRequestClass();

        $this->assertSame(ExportCreateRequest::class, $result);
    }

    /**
     * Tests the requiresAuthorizationToken method.
     * @covers ::requiresAuthorizationToken
     */
    public function testRequiresAuthorizationToken(): void
    {
        $endpoint = new ExportCreateEndpoint();
        $result = $endpoint->requiresAuthorizationToken();

        $this->assertTrue($result);
    }

    /**
     * Tests the getRequestPath method.
     * @covers ::getRequestPath
     */
    public function testGetRequestPath(): void
    {
        $endpoint = new ExportCreateEndpoint();
        $result = $endpoint->getRequestPath();

        $this->assertSame('export/create', $result);
    }

    /**
     * Tests the getResponseClass method.
     * @covers ::getResponseClass
     */
    public function testGetResponseClass(): void
    {
        $endpoint = new ExportCreateEndpoint();
        $result = $endpoint->getResponseClass();

        $this->assertSame(ExportCreateResponse::class, $result);
    }
}

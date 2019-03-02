<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Endpoint\Search;

use FactorioItemBrowser\Api\Client\Endpoint\Search\SearchQueryEndpoint;
use FactorioItemBrowser\Api\Client\Request\Search\SearchQueryRequest;
use FactorioItemBrowser\Api\Client\Response\Search\SearchQueryResponse;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the SearchQueryEndpoint class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Endpoint\Search\SearchQueryEndpoint
 */
class SearchQueryEndpointTest extends TestCase
{
    /**
     * Tests the getSupportedRequestClass method.
     * @covers ::getSupportedRequestClass
     */
    public function testGetSupportedRequestClass(): void
    {
        $endpoint = new SearchQueryEndpoint();
        $result = $endpoint->getSupportedRequestClass();

        $this->assertSame(SearchQueryRequest::class, $result);
    }

    /**
     * Tests the requiresAuthorizationToken method.
     * @covers ::requiresAuthorizationToken
     */
    public function testRequiresAuthorizationToken(): void
    {
        $endpoint = new SearchQueryEndpoint();
        $result = $endpoint->requiresAuthorizationToken();

        $this->assertTrue($result);
    }

    /**
     * Tests the getRequestPath method.
     * @covers ::getRequestPath
     */
    public function testGetRequestPath(): void
    {
        $endpoint = new SearchQueryEndpoint();
        $result = $endpoint->getRequestPath();

        $this->assertSame('search/query', $result);
    }

    /**
     * Tests the getResponseClass method.
     * @covers ::getResponseClass
     */
    public function testGetResponseClass(): void
    {
        $endpoint = new SearchQueryEndpoint();
        $result = $endpoint->getResponseClass();

        $this->assertSame(SearchQueryResponse::class, $result);
    }
}

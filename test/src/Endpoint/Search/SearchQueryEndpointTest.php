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
 * @covers \FactorioItemBrowser\Api\Client\Endpoint\Search\SearchQueryEndpoint
 */
class SearchQueryEndpointTest extends TestCase
{
    public function test(): void
    {
        $request = new SearchQueryRequest();
        $request->combinationId = 'abc';

        $instance = new SearchQueryEndpoint();
        $this->assertSame(SearchQueryRequest::class, $instance->getHandledRequestClass());
        $this->assertSame('abc/search/query', $instance->getRequestPath($request));
        $this->assertSame(SearchQueryResponse::class, $instance->getResponseClass());
    }
}

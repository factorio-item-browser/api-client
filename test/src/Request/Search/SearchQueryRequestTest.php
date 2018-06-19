<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Request\Search;

use FactorioItemBrowser\Api\Client\Request\Search\SearchQueryRequest;
use FactorioItemBrowser\Api\Client\Response\Search\SearchQueryResponse;
use FactorioItemBrowserTestAsset\Api\Client\Response\TestPendingResponse;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the search query request class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Request\Search\SearchQueryRequest
 */
class SearchQueryRequestTest extends TestCase
{
    /**
     * Tests getting the request path.
     * @covers ::getRequestPath
     */
    public function testGetRequestPath()
    {
        $request = new SearchQueryRequest();
        $this->assertSame('/search/query', $request->getRequestPath());
    }

    /**
     * Tests getting the request data.
     * @covers ::getRequestData
     * @covers ::setQuery
     * @covers ::setNumberOfResults
     * @covers ::setIndexOfFirstResult
     * @covers ::setNumberOfRecipesPerResult
     */
    public function testGetRequestData()
    {
        $request = new SearchQueryRequest();
        $this->assertSame($request, $request->setQuery('abc'));
        $this->assertSame($request, $request->setNumberOfResults(42));
        $this->assertSame($request, $request->setIndexOfFirstResult(21));
        $this->assertSame($request, $request->setNumberOfRecipesPerResult(1337));

        $expectedData = [
            'query' => 'abc',
            'numberOfResults' => 42,
            'indexOfFirstResult' => 21,
            'numberOfRecipesPerResult' => 1337
        ];
        $this->assertEquals($expectedData, $request->getRequestData());
    }

    /**
     * Tests creating the response.
     * @covers ::createResponse
     */
    public function testCreateResponse()
    {
        $request = new SearchQueryRequest();
        $this->assertInstanceOf(SearchQueryResponse::class, $request->createResponse(new TestPendingResponse()));
    }
}

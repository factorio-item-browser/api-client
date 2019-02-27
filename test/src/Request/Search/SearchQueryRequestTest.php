<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Request\Search;

use FactorioItemBrowser\Api\Client\Request\Search\SearchQueryRequest;
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
     * Tests the setting and getting the query.
     * @covers ::getQuery
     * @covers ::setQuery
     */
    public function testSetAndGetQuery(): void
    {
        $query = 'abc';
        $request = new SearchQueryRequest();

        $this->assertSame($request, $request->setQuery($query));
        $this->assertSame($query, $request->getQuery());
    }

    /**
     * Tests the setting and getting the number of results.
     * @covers ::getNumberOfResults
     * @covers ::setNumberOfResults
     */
    public function testSetAndGetNumberOfResults(): void
    {
        $numberOfResults = 42;
        $request = new SearchQueryRequest();

        $this->assertSame($request, $request->setNumberOfResults($numberOfResults));
        $this->assertSame($numberOfResults, $request->getNumberOfResults());
    }

    /**
     * Tests the setting and getting the index of first result.
     * @covers ::getIndexOfFirstResult
     * @covers ::setIndexOfFirstResult
     */
    public function testSetAndGetIndexOfFirstResult(): void
    {
        $indexOfFirstResult = 42;
        $request = new SearchQueryRequest();

        $this->assertSame($request, $request->setIndexOfFirstResult($indexOfFirstResult));
        $this->assertSame($indexOfFirstResult, $request->getIndexOfFirstResult());
    }

    /**
     * Tests the setting and getting the number of recipes per result.
     * @covers ::getNumberOfRecipesPerResult
     * @covers ::setNumberOfRecipesPerResult
     */
    public function testSetAndGetNumberOfRecipesPerResult(): void
    {
        $numberOfRecipesPerResult = 42;
        $request = new SearchQueryRequest();

        $this->assertSame($request, $request->setNumberOfRecipesPerResult($numberOfRecipesPerResult));
        $this->assertSame($numberOfRecipesPerResult, $request->getNumberOfRecipesPerResult());
    }
}

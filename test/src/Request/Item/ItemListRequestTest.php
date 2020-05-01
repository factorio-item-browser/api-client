<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Request\Item;

use FactorioItemBrowser\Api\Client\Request\Item\ItemListRequest;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the ItemListRequest class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Request\Item\ItemListRequest
 */
class ItemListRequestTest extends TestCase
{
    /**
     * Tests the constructing.
     * @coversNothing
     */
    public function testConstruct(): void
    {
        $request = new ItemListRequest();

        $this->assertSame(10, $request->getNumberOfResults());
        $this->assertSame(0, $request->getIndexOfFirstResult());
        $this->assertSame(3, $request->getNumberOfRecipesPerResult());
    }

    /**
     * Tests the setting and getting the number of results.
     * @covers ::getNumberOfResults
     * @covers ::setNumberOfResults
     */
    public function testSetAndGetNumberOfResults(): void
    {
        $numberOfResults = 42;
        $request = new ItemListRequest();

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
        $request = new ItemListRequest();

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
        $request = new ItemListRequest();

        $this->assertSame($request, $request->setNumberOfRecipesPerResult($numberOfRecipesPerResult));
        $this->assertSame($numberOfRecipesPerResult, $request->getNumberOfRecipesPerResult());
    }
}

<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Request\Recipe;

use FactorioItemBrowser\Api\Client\Request\Recipe\RecipeListRequest;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the RecipeListRequest class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Request\Recipe\RecipeListRequest
 */
class RecipeListRequestTest extends TestCase
{
    /**
     * Tests the constructing.
     * @coversNothing
     */
    public function testConstruct(): void
    {
        $request = new RecipeListRequest();

        $this->assertSame(10, $request->getNumberOfResults());
        $this->assertSame(0, $request->getIndexOfFirstResult());
    }

    /**
     * Tests the setting and getting the number of results.
     * @covers ::getNumberOfResults
     * @covers ::setNumberOfResults
     */
    public function testSetAndGetNumberOfResults(): void
    {
        $numberOfResults = 42;
        $request = new RecipeListRequest();

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
        $request = new RecipeListRequest();

        $this->assertSame($request, $request->setIndexOfFirstResult($indexOfFirstResult));
        $this->assertSame($indexOfFirstResult, $request->getIndexOfFirstResult());
    }
}

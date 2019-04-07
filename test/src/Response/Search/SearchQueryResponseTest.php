<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Response\Search;

use FactorioItemBrowser\Api\Client\Entity\GenericEntityWithRecipes;
use FactorioItemBrowser\Api\Client\Response\Search\SearchQueryResponse;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * The PHPUnit test of the search query response class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Response\Search\SearchQueryResponse
 */
class SearchQueryResponseTest extends TestCase
{
    /**
     * Tests the constructing.
     * @coversNothing
     */
    public function testConstruct(): void
    {
        $response = new SearchQueryResponse();

        $this->assertSame([], $response->getResults());
        $this->assertSame(0, $response->getTotalNumberOfResults());
    }


    /**
     * Tests setting, adding and getting the results.
     * @throws ReflectionException
     * @covers ::addResult
     * @covers ::setResults
     * @covers ::getResults
     */
    public function testSetAddAndGetResults(): void
    {
        /* @var GenericEntityWithRecipes&MockObject $result1 */
        $result1 = $this->createMock(GenericEntityWithRecipes::class);
        /* @var GenericEntityWithRecipes&MockObject $result2 */
        $result2 = $this->createMock(GenericEntityWithRecipes::class);
        /* @var GenericEntityWithRecipes&MockObject $result3 */
        $result3 = $this->createMock(GenericEntityWithRecipes::class);

        $response = new SearchQueryResponse();
        $this->assertSame($response, $response->setResults([$result1, $result2]));
        $this->assertSame([$result1, $result2], $response->getResults());

        $this->assertSame($response, $response->addResult($result3));
        $this->assertSame([$result1, $result2, $result3], $response->getResults());
    }

    /**
     * Tests the setting and getting the total number of results.
     * @covers ::getTotalNumberOfResults
     * @covers ::setTotalNumberOfResults
     */
    public function testSetAndGetTotalNumberOfResults(): void
    {
        $totalNumberOfResults = 42;
        $response = new SearchQueryResponse();

        $this->assertSame($response, $response->setTotalNumberOfResults($totalNumberOfResults));
        $this->assertSame($totalNumberOfResults, $response->getTotalNumberOfResults());
    }
}

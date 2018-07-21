<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Response\Search;

use FactorioItemBrowser\Api\Client\Entity\GenericEntityWithRecipes;
use FactorioItemBrowser\Api\Client\Response\Search\SearchQueryResponse;
use FactorioItemBrowserTestAsset\Api\Client\Response\TestPendingResponse;
use PHPUnit\Framework\TestCase;

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
     * Tests mapping and getting the results.
     * @covers ::getResults
     * @covers ::mapResponse
     */
    public function testGetResults()
    {
        $responseData = [
            'results' => [
                ['name' => 'abc'],
                ['name' => 'def']
            ]
        ];
        $entity1 = new GenericEntityWithRecipes();
        $entity1->setName('abc');
        $entity2 = new GenericEntityWithRecipes();
        $entity2->setName('def');

        $response = new SearchQueryResponse(new TestPendingResponse($responseData));
        $this->assertEquals([$entity1, $entity2], $response->getResults());
    }

    /**
     * Tests mapping and getting the total number of results.
     * @covers ::getTotalNumberOfResults
     * @covers ::mapResponse
     */
    public function testGetTotalNumberOfResults()
    {
        $responseData = [
            'totalNumberOfResults' => 42
        ];

        $response = new SearchQueryResponse(new TestPendingResponse($responseData));
        $this->assertEquals(42, $response->getTotalNumberOfResults());
    }
}

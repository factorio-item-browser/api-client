<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Response\Item;

use FactorioItemBrowser\Api\Client\Entity\GenericEntityWithRecipes;
use FactorioItemBrowser\Api\Client\Response\Item\ItemListResponse;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the ItemListResponse class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Response\Item\ItemListResponse
 */
class ItemListResponseTest extends TestCase
{
    /**
     * Tests the constructing.
     * @coversNothing
     */
    public function testConstruct(): void
    {
        $response = new ItemListResponse();

        $this->assertSame([], $response->getItems());
        $this->assertSame(0, $response->getTotalNumberOfResults());
    }

    /**
     * Tests setting, adding and getting the items.
     * @covers ::addItem
     * @covers ::setItems
     * @covers ::getItems
     */
    public function testSetAddAndGetItems(): void
    {
        /* @var GenericEntityWithRecipes&MockObject $item1 */
        $item1 = $this->createMock(GenericEntityWithRecipes::class);
        /* @var GenericEntityWithRecipes&MockObject $item2 */
        $item2 = $this->createMock(GenericEntityWithRecipes::class);
        /* @var GenericEntityWithRecipes&MockObject $item3 */
        $item3 = $this->createMock(GenericEntityWithRecipes::class);

        $response = new ItemListResponse();
        $this->assertSame($response, $response->setItems([$item1, $item2]));
        $this->assertSame([$item1, $item2], $response->getItems());

        $this->assertSame($response, $response->addItem($item3));
        $this->assertSame([$item1, $item2, $item3], $response->getItems());
    }

    /**
     * Tests the setting and getting the total number of results.
     * @covers ::getTotalNumberOfResults
     * @covers ::setTotalNumberOfResults
     */
    public function testSetAndGetTotalNumberOfResults(): void
    {
        $totalNumberOfResults = 42;
        $response = new ItemListResponse();

        $this->assertSame($response, $response->setTotalNumberOfResults($totalNumberOfResults));
        $this->assertSame($totalNumberOfResults, $response->getTotalNumberOfResults());
    }
}

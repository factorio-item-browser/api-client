<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Response\Item;

use FactorioItemBrowser\Api\Client\Entity\GenericEntityWithRecipes;
use FactorioItemBrowser\Api\Client\Response\Item\ItemProductResponse;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * The PHPUnit test of the item product response class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Response\Item\ItemProductResponse
 */
class ItemProductResponseTest extends TestCase
{
    /**
     * Tests the constructing.
     * @covers ::__construct
     */
    public function testConstruct(): void
    {
        $response = new ItemProductResponse();

        $this->assertEquals(new GenericEntityWithRecipes(), $response->getItem());
    }

    /**
     * Tests the setting and getting the item.
     * @throws ReflectionException
     * @covers ::getItem
     * @covers ::setItem
     */
    public function testSetAndGetItem(): void
    {
        /* @var GenericEntityWithRecipes&MockObject $item */
        $item = $this->createMock(GenericEntityWithRecipes::class);

        $response = new ItemProductResponse();

        $this->assertSame($response, $response->setItem($item));
        $this->assertSame($item, $response->getItem());
    }
}

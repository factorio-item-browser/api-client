<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Entity;

use FactorioItemBrowser\Api\Client\Entity\Item;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the item class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Entity\Item
 */
class ItemTest extends TestCase
{
    /**
     * Tests the constructing.
     * @coversNothing
     */
    public function testConstruct(): void
    {
        $item = new Item();

        $this->assertSame('', $item->getType());
        $this->assertSame('', $item->getName());
        $this->assertSame('', $item->getLabel());
        $this->assertSame('', $item->getDescription());
        $this->assertSame(0., $item->getAmount());
    }

    /**
     * Tests the setting and getting the amount.
     * @covers ::getAmount
     * @covers ::setAmount
     */
    public function testSetAndGetAmount(): void
    {
        $amount = 13.37;
        $entity = new Item();

        $this->assertSame($entity, $entity->setAmount($amount));
        $this->assertSame($amount, $entity->getAmount());
    }
}

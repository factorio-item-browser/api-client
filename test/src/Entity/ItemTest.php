<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Entity;

use BluePsyduck\Common\Data\DataContainer;
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
    public function testConstruct()
    {
        $item = new Item();
        $this->assertSame('', $item->getType());
        $this->assertSame('', $item->getName());
        $this->assertSame('', $item->getLabel());
        $this->assertSame('', $item->getDescription());
        $this->assertSame(0., $item->getAmount());
    }

    /**
     * Tests setting and getting the amount.
     * @covers ::setAmount
     * @covers ::getAmount
     */
    public function testSetAndGetAmount()
    {
        $item = new Item();
        $this->assertSame($item, $item->setAmount(13.37));
        $this->assertSame(13.37, $item->getAmount());
    }

    /**
     * Tests writing and reading the data.
     * @covers ::writeData
     * @covers ::readData
     */
    public function testWriteAndReadData()
    {
        $item = new Item();
        $item->setType('abc')
             ->setName('def')
             ->setLabel('ghi')
             ->setDescription('jkl')
             ->setAmount(13.37);

        $expectedData = [
            'type' => 'abc',
            'name' => 'def',
            'label' => 'ghi',
            'description' => 'jkl',
            'amount' => 13.37
        ];

        $data = $item->writeData();
        $this->assertEquals($expectedData, $data);

        $newItem = new Item();
        $this->assertSame($newItem, $newItem->readData(new DataContainer($data)));
        $this->assertEquals($newItem, $item);
    }
}

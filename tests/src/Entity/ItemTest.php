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
 * @coversDefaultClass FactorioItemBrowser\Api\Client\Entity\Item
 */
class ItemTest extends TestCase
{
    /**
     * Tests the constructing.
     */
    public function testConstruct()
    {
        $item = new Item();
        $this->assertEquals('', $item->getType());
        $this->assertEquals('', $item->getName());
        $this->assertEquals('', $item->getLabel());
        $this->assertEquals('', $item->getDescription());
        $this->assertEquals(0., $item->getAmount());
        $this->assertEquals('', $item->getTranslationType());
    }

    /**
     * Tests setting and getting the type.
     */
    public function testSetAndGetType()
    {
        $item = new Item();
        $this->assertEquals($item, $item->setType('abc'));
        $this->assertEquals('abc', $item->getType());
    }

    /**
     * Tests setting and getting the name.
     */
    public function testSetAndGetName()
    {
        $item = new Item();
        $this->assertEquals($item, $item->setName('abc'));
        $this->assertEquals('abc', $item->getName());
    }

    /**
     * Tests setting and getting the label.
     */
    public function testSetAndGetLabel()
    {
        $item = new Item();
        $this->assertEquals($item, $item->setLabel('abc'));
        $this->assertEquals('abc', $item->getLabel());
    }

    /**
     * Tests setting and getting the description.
     */
    public function testSetAndGetDescription()
    {
        $item = new Item();
        $this->assertEquals($item, $item->setDescription('abc'));
        $this->assertEquals('abc', $item->getDescription());
    }

    /**
     * Tests setting and getting the amount.
     */
    public function testSetAndGetAmount()
    {
        $item = new Item();
        $this->assertEquals($item, $item->setAmount(13.37));
        $this->assertEquals(13.37, $item->getAmount());
    }

    /**
     * Tests getting the translation type.
     */
    public function testGetTranslationType()
    {
        $item = new Item();
        $item->setType('abc');
        $this->assertEquals('abc', $item->getTranslationType());
    }

    /**
     * Tests writing and reading the data.
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
        $this->assertEquals($newItem, $newItem->readData(new DataContainer($data)));
        $this->assertEquals($newItem, $item);
    }
}

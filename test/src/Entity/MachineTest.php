<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Entity;

use BluePsyduck\Common\Data\DataContainer;
use FactorioItemBrowser\Api\Client\Entity\Machine;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the machine class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Entity\Machine
 */
class MachineTest extends TestCase
{
    /**
     * Tests the constructing.
     * @coversNothing
     */
    public function testConstruct()
    {
        $machine = new Machine();
        $this->assertEquals('machine', $machine->getType());
        $this->assertEquals('', $machine->getName());
        $this->assertEquals('', $machine->getLabel());
        $this->assertEquals('', $machine->getDescription());
        $this->assertEquals(1., $machine->getCraftingSpeed());
        $this->assertEquals(0, $machine->getNumberOfIngredientSlots());
        $this->assertEquals(0, $machine->getNumberOfModuleSlots());
        $this->assertEquals(0, $machine->getEnergyUsage());
    }

    /**
     * Tests getting the type.
     * @covers ::getType
     */
    public function testGetType()
    {
        $machine = new Machine();
        $this->assertEquals('machine', $machine->getType());
    }

    /**
     * Tests setting and getting the crafting speed.
     * @covers ::setCraftingSpeed
     * @covers ::getCraftingSpeed
     */
    public function testSetAndGetCraftingSpeed()
    {
        $machine = new Machine();
        $this->assertEquals($machine, $machine->setCraftingSpeed(13.37));
        $this->assertEquals(13.37, $machine->getCraftingSpeed());
    }

    /**
     * Tests setting and getting the number of ingredient slots.
     * @covers ::setNumberOfIngredientSlots
     * @covers ::getNumberOfIngredientSlots
     */
    public function testSetAndGetNumberOfIngredientSlots()
    {
        $machine = new Machine();
        $this->assertEquals($machine, $machine->setNumberOfIngredientSlots(42));
        $this->assertEquals(42, $machine->getNumberOfIngredientSlots());
    }

    /**
     * Tests setting and getting the number of module slots.
     * @covers ::setNumberOfModuleSlots
     * @covers ::getNumberOfModuleSlots
     */
    public function testSetAndGetNumberOfModuleSlots()
    {
        $machine = new Machine();
        $this->assertEquals($machine, $machine->setNumberOfModuleSlots(42));
        $this->assertEquals(42, $machine->getNumberOfModuleSlots());
    }

    /**
     * Tests setting and getting the energy usage.
     * @covers ::setEnergyUsage
     * @covers ::getEnergyUsage
     */
    public function testSetAndGetEnergyUsage()
    {
        $machine = new Machine();
        $this->assertEquals($machine, $machine->setEnergyUsage(1337));
        $this->assertEquals(1337, $machine->getEnergyUsage());
    }

    /**
     * Tests writing and reading the data.
     * @covers ::writeData
     * @covers ::readData
     */
    public function testWriteAndReadData()
    {
        $machine = new Machine();
        $machine->setName('abc')
                ->setLabel('def')
                ->setDescription('ghi')
                ->setCraftingSpeed(13.37)
                ->setNumberOfIngredientSlots(42)
                ->setNumberOfModuleSlots(21)
                ->setEnergyUsage(1337);

        $expectedData = [
            'name' => 'abc',
            'label' => 'def',
            'description' => 'ghi',
            'craftingSpeed' => 13.37,
            'numberOfIngredientSlots' => 42,
            'numberOfModuleSlots' => 21,
            'energyUsage' => 1337
        ];

        $data = $machine->writeData();
        $this->assertEquals($expectedData, $data);

        $newMachine = new Machine();
        $this->assertEquals($newMachine, $newMachine->readData(new DataContainer($data)));
        $this->assertEquals($newMachine, $machine);
    }
}

<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Entity;

use BluePsyduck\Common\Data\DataContainer;
use FactorioItemBrowser\Api\Client\Constant\EnergyUsageUnit;
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
        $this->assertSame('machine', $machine->getType());
        $this->assertSame('', $machine->getName());
        $this->assertSame('', $machine->getLabel());
        $this->assertSame('', $machine->getDescription());
        $this->assertSame(0., $machine->getCraftingSpeed());
        $this->assertSame(0, $machine->getNumberOfItemSlots());
        $this->assertSame(0, $machine->getNumberOfFluidInputSlots());
        $this->assertSame(0, $machine->getNumberOfFluidOutputSlots());
        $this->assertSame(0, $machine->getNumberOfModuleSlots());
        $this->assertSame(0., $machine->getEnergyUsage());
        $this->assertSame(EnergyUsageUnit::WATT, $machine->getEnergyUsageUnit());
    }

    /**
     * Tests getting the type.
     * @covers ::getType
     */
    public function testGetType()
    {
        $machine = new Machine();
        $this->assertSame('machine', $machine->getType());
    }

    /**
     * Tests setting and getting the crafting speed.
     * @covers ::setCraftingSpeed
     * @covers ::getCraftingSpeed
     */
    public function testSetAndGetCraftingSpeed()
    {
        $machine = new Machine();
        $this->assertSame($machine, $machine->setCraftingSpeed(13.37));
        $this->assertSame(13.37, $machine->getCraftingSpeed());
    }

    /**
     * Tests setting and getting the number of item slots.
     * @covers ::setNumberOfItemSlots
     * @covers ::getNumberOfItemSlots
     */
    public function testSetAndGetNumberOfItemSlots()
    {
        $machine = new Machine();
        $this->assertSame($machine, $machine->setNumberOfItemSlots(42));
        $this->assertSame(42, $machine->getNumberOfItemSlots());
    }

    /**
     * Tests setting and getting the number of fluid input slots.
     * @covers ::setNumberOfFluidInputSlots
     * @covers ::getNumberOfFluidInputSlots
     */
    public function testSetAndGetNumberOfFluidInputSlots()
    {
        $machine = new Machine();
        $this->assertSame($machine, $machine->setNumberOfFluidInputSlots(42));
        $this->assertSame(42, $machine->getNumberOfFluidInputSlots());
    }

    /**
     * Tests setting and getting the number of fluid output slots.
     * @covers ::setNumberOfFluidOutputSlots
     * @covers ::getNumberOfFluidOutputSlots
     */
    public function testSetAndGetNumberOfFluidOutputSlots()
    {
        $machine = new Machine();
        $this->assertSame($machine, $machine->setNumberOfFluidOutputSlots(42));
        $this->assertSame(42, $machine->getNumberOfFluidOutputSlots());
    }

    /**
     * Tests setting and getting the number of module slots.
     * @covers ::setNumberOfModuleSlots
     * @covers ::getNumberOfModuleSlots
     */
    public function testSetAndGetNumberOfModuleSlots()
    {
        $machine = new Machine();
        $this->assertSame($machine, $machine->setNumberOfModuleSlots(42));
        $this->assertSame(42, $machine->getNumberOfModuleSlots());
    }

    /**
     * Tests setting and getting the energy usage.
     * @covers ::setEnergyUsage
     * @covers ::getEnergyUsage
     */
    public function testSetAndGetEnergyUsage()
    {
        $machine = new Machine();
        $this->assertSame($machine, $machine->setEnergyUsage(13.37));
        $this->assertSame(13.37, $machine->getEnergyUsage());
    }

    /**
     * Tests setting and getting the energyUsageUnit.
     * @covers ::setEnergyUsageUnit
     * @covers ::getEnergyUsageUnit
     */
    public function testSetAndGetEnergyUsageUnit()
    {
        $machine = new Machine();
        $this->assertSame($machine, $machine->setEnergyUsageUnit('abc'));
        $this->assertSame('abc', $machine->getEnergyUsageUnit());
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
                ->setNumberOfItemSlots(42)
                ->setNumberOfFluidInputSlots(21)
                ->setNumberOfFluidOutputSlots(13)
                ->setNumberOfModuleSlots(37)
                ->setEnergyUsage(73.31)
                ->setEnergyUsageUnit('jkl');

        $expectedData = [
            'name' => 'abc',
            'label' => 'def',
            'description' => 'ghi',
            'craftingSpeed' => 13.37,
            'numberOfItemSlots' => 42,
            'numberOfFluidInputSlots' => 21,
            'numberOfFluidOutputSlots' => 13,
            'numberOfModuleSlots' => 37,
            'energyUsage' => 73.31,
            'energyUsageUnit' => 'jkl'
        ];

        $data = $machine->writeData();
        $this->assertEquals($expectedData, $data);

        $newMachine = new Machine();
        $this->assertSame($newMachine, $newMachine->readData(new DataContainer($data)));
        $this->assertEquals($newMachine, $machine);
    }
}

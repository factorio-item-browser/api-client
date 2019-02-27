<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Entity;

use FactorioItemBrowser\Api\Client\Constant\EnergyUsageUnit;
use FactorioItemBrowser\Api\Client\Constant\EntityType;
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
     * @covers ::getType
     */
    public function testConstruct(): void
    {
        $machine = new Machine();

        $this->assertSame(EntityType::MACHINE, $machine->getType());
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
     * Tests the setting and getting the crafting speed.
     * @covers ::getCraftingSpeed
     * @covers ::setCraftingSpeed
     */
    public function testSetAndGetCraftingSpeed(): void
    {
        $craftingSpeed = 13.37;
        $entity = new Machine();

        $this->assertSame($entity, $entity->setCraftingSpeed($craftingSpeed));
        $this->assertSame($craftingSpeed, $entity->getCraftingSpeed());
    }

    /**
     * Tests the setting and getting the number of item slots.
     * @covers ::getNumberOfItemSlots
     * @covers ::setNumberOfItemSlots
     */
    public function testSetAndGetNumberOfItemSlots(): void
    {
        $numberOfItemSlots = 42;
        $entity = new Machine();

        $this->assertSame($entity, $entity->setNumberOfItemSlots($numberOfItemSlots));
        $this->assertSame($numberOfItemSlots, $entity->getNumberOfItemSlots());
    }

    /**
     * Tests the setting and getting the number of fluid input slots.
     * @covers ::getNumberOfFluidInputSlots
     * @covers ::setNumberOfFluidInputSlots
     */
    public function testSetAndGetNumberOfFluidInputSlots(): void
    {
        $numberOfFluidInputSlots = 42;
        $entity = new Machine();

        $this->assertSame($entity, $entity->setNumberOfFluidInputSlots($numberOfFluidInputSlots));
        $this->assertSame($numberOfFluidInputSlots, $entity->getNumberOfFluidInputSlots());
    }

    /**
     * Tests the setting and getting the number of fluid output slots.
     * @covers ::getNumberOfFluidOutputSlots
     * @covers ::setNumberOfFluidOutputSlots
     */
    public function testSetAndGetNumberOfFluidOutputSlots(): void
    {
        $numberOfFluidOutputSlots = 42;
        $entity = new Machine();

        $this->assertSame($entity, $entity->setNumberOfFluidOutputSlots($numberOfFluidOutputSlots));
        $this->assertSame($numberOfFluidOutputSlots, $entity->getNumberOfFluidOutputSlots());
    }

    /**
     * Tests the setting and getting the number of module slots.
     * @covers ::getNumberOfModuleSlots
     * @covers ::setNumberOfModuleSlots
     */
    public function testSetAndGetNumberOfModuleSlots(): void
    {
        $numberOfModuleSlots = 42;
        $entity = new Machine();

        $this->assertSame($entity, $entity->setNumberOfModuleSlots($numberOfModuleSlots));
        $this->assertSame($numberOfModuleSlots, $entity->getNumberOfModuleSlots());
    }

    /**
     * Tests the setting and getting the energy usage.
     * @covers ::getEnergyUsage
     * @covers ::setEnergyUsage
     */
    public function testSetAndGetEnergyUsage(): void
    {
        $energyUsage = 13.37;
        $entity = new Machine();

        $this->assertSame($entity, $entity->setEnergyUsage($energyUsage));
        $this->assertSame($energyUsage, $entity->getEnergyUsage());
    }

    /**
     * Tests the setting and getting the energy usage unit.
     * @covers ::getEnergyUsageUnit
     * @covers ::setEnergyUsageUnit
     */
    public function testSetAndGetEnergyUsageUnit(): void
    {
        $energyUsageUnit = 'abc';
        $entity = new Machine();

        $this->assertSame($entity, $entity->setEnergyUsageUnit($energyUsageUnit));
        $this->assertSame($energyUsageUnit, $entity->getEnergyUsageUnit());
    }
}

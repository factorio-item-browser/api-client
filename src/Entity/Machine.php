<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Entity;

use BluePsyduck\Common\Data\DataContainer;
use FactorioItemBrowser\Api\Client\Constant\EnergyUsageUnit;
use FactorioItemBrowser\Api\Client\Constant\EntityType;

/**
 * The entity representing a machine crafting recipes.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Machine extends GenericEntity
{
    /**
     * The crafting speed of the machine.
     * @var float
     */
    protected $craftingSpeed = 0.;

    /**
     * The number of item slots available in the machine.
     * @var int
     */
    protected $numberOfItemSlots = 0;

    /**
     * The number of fluid input slots available in the machine.
     * @var int
     */
    protected $numberOfFluidInputSlots = 0;

    /**
     * The number of fluid output slots available in the machine.
     * @var int
     */
    protected $numberOfFluidOutputSlots = 0;

    /**
     * The number of module slots available in the machine.
     * @var int
     */
    protected $numberOfModuleSlots = 0;

    /**
     * The energy usage of the machine.
     * @var float
     */
    protected $energyUsage = 0.;

    /**
     * The unit of the energy usage.
     * @var string
     */
    protected $energyUsageUnit = EnergyUsageUnit::WATT;

    /**
     * Returns the type of the entity.
     * @return string
     */
    public function getType(): string
    {
        return EntityType::MACHINE;
    }

    /**
     * Sets the crafting speed of the machine.
     * @param float $craftingSpeed
     * @return $this
     */
    public function setCraftingSpeed(float $craftingSpeed)
    {
        $this->craftingSpeed = $craftingSpeed;
        return $this;
    }

    /**
     * Returns the crafting speed of the machine.
     * @return float
     */
    public function getCraftingSpeed(): float
    {
        return $this->craftingSpeed;
    }

    /**
     * Sets the number of item slots available in the machine, or -1 if unlimited.
     * @param int $numberOfItemSlots
     * @return $this
     */
    public function setNumberOfItemSlots(int $numberOfItemSlots)
    {
        $this->numberOfItemSlots = $numberOfItemSlots;
        return $this;
    }

    /**
     * Returns the number of item slots available in the machine, or -1 if unlimited.
     * @return int
     */
    public function getNumberOfItemSlots(): int
    {
        return $this->numberOfItemSlots;
    }

    /**
     * Sets the number of fluid input slots available in the machine.
     * @param int $numberOfFluidInputSlots
     * @return $this
     */
    public function setNumberOfFluidInputSlots(int $numberOfFluidInputSlots)
    {
        $this->numberOfFluidInputSlots = $numberOfFluidInputSlots;
        return $this;
    }

    /**
     * Returns the number of fluid input slots available in the machine.
     * @return int
     */
    public function getNumberOfFluidInputSlots(): int
    {
        return $this->numberOfFluidInputSlots;
    }

    /**
     * Sets the number of fluid output slots available in the machine.
     * @param int $numberOfFluidOutputSlots
     * @return $this
     */
    public function setNumberOfFluidOutputSlots(int $numberOfFluidOutputSlots)
    {
        $this->numberOfFluidOutputSlots = $numberOfFluidOutputSlots;
        return $this;
    }

    /**
     * Returns the number of fluid output slots available in the machine.
     * @return int
     */
    public function getNumberOfFluidOutputSlots(): int
    {
        return $this->numberOfFluidOutputSlots;
    }

    /**
     * Sets the number of module slots available in the machine.
     * @param int $numberOfModuleSlots
     * @return $this
     */
    public function setNumberOfModuleSlots(int $numberOfModuleSlots)
    {
        $this->numberOfModuleSlots = $numberOfModuleSlots;
        return $this;
    }

    /**
     * Returns the number of module slots available in the machine.
     * @return int
     */
    public function getNumberOfModuleSlots(): int
    {
        return $this->numberOfModuleSlots;
    }

    /**
     * Sets the energy usage of the machine
     * @param float $energyUsage
     * @return $this
     */
    public function setEnergyUsage(float $energyUsage)
    {
        $this->energyUsage = $energyUsage;
        return $this;
    }

    /**
     * Returns the energy usage of the machine.
     * @return float
     */
    public function getEnergyUsage(): float
    {
        return $this->energyUsage;
    }

    /**
     * Sets the unit of the energy usage.
     * @param string $energyUsageUnit
     * @return $this
     */
    public function setEnergyUsageUnit(string $energyUsageUnit)
    {
        $this->energyUsageUnit = $energyUsageUnit;
        return $this;
    }

    /**
     * Returns the unit of the energy usage.
     * @return string
     */
    public function getEnergyUsageUnit(): string
    {
        return $this->energyUsageUnit;
    }

    /**
     * Writes the entity data to an array.
     * @return array
     */
    public function writeData(): array
    {
        $data = array_merge(parent::writeData(), [
            'craftingSpeed' => $this->craftingSpeed,
            'numberOfItemSlots' => $this->numberOfItemSlots,
            'numberOfFluidInputSlots' => $this->numberOfFluidInputSlots,
            'numberOfFluidOutputSlots' => $this->numberOfFluidOutputSlots,
            'numberOfModuleSlots' => $this->numberOfModuleSlots,
            'energyUsage' => $this->energyUsage,
            'energyUsageUnit' => $this->energyUsageUnit
        ]);
        unset($data['type']);
        return $data;
    }

    /**
     * Reads the entity data.
     * @param DataContainer $data
     * @return $this
     */
    public function readData(DataContainer $data)
    {
        parent::readData($data);
        $this->craftingSpeed = $data->getFloat('craftingSpeed');
        $this->numberOfItemSlots = $data->getInteger('numberOfItemSlots');
        $this->numberOfFluidInputSlots = $data->getInteger('numberOfFluidInputSlots');
        $this->numberOfFluidOutputSlots = $data->getInteger('numberOfFluidOutputSlots');
        $this->numberOfModuleSlots = $data->getInteger('numberOfModuleSlots');
        $this->energyUsage = $data->getFloat('energyUsage');
        $this->energyUsageUnit = $data->getString('energyUsageUnit');
        return $this;
    }
}
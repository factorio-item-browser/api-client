<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Entity;

use BluePsyduck\Common\Data\DataContainer;
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
     * The number of ingredient slots available in the machine.
     * @var int
     */
    protected $numberOfIngredientSlots = 0;

    /**
     * The number of module slots available in the machine.
     * @var int
     */
    protected $numberOfModuleSlots = 0;

    /**
     * The energy usage of the machine, in watt.
     * @var int
     */
    protected $energyUsage = 0;

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
     * Sets the number of ingredient slots available in the machine.
     * @param int $numberOfIngredientSlots
     * @return $this
     */
    public function setNumberOfIngredientSlots(int $numberOfIngredientSlots)
    {
        $this->numberOfIngredientSlots = $numberOfIngredientSlots;
        return $this;
    }

    /**
     * Returns the number of ingredient slots available in the machine.
     * @return int
     */
    public function getNumberOfIngredientSlots(): int
    {
        return $this->numberOfIngredientSlots;
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
     * Sets the energy usage of the machine, in watt.
     * @param int $energyUsage
     * @return $this
     */
    public function setEnergyUsage(int $energyUsage)
    {
        $this->energyUsage = $energyUsage;
        return $this;
    }

    /**
     * Returns the energy usage of the machine, in watt.
     * @return int
     */
    public function getEnergyUsage(): int
    {
        return $this->energyUsage;
    }

    /**
     * Writes the entity data to an array.
     * @return array
     */
    public function writeData(): array
    {
        $data = array_merge(parent::writeData(), [
            'craftingSpeed' => $this->craftingSpeed,
            'numberOfIngredientSlots' => $this->numberOfIngredientSlots,
            'numberOfModuleSlots' => $this->numberOfModuleSlots,
            'energyUsage' => $this->energyUsage
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
        $this->numberOfIngredientSlots = $data->getInteger('numberOfIngredientSlots');
        $this->numberOfModuleSlots = $data->getInteger('numberOfModuleSlots');
        $this->energyUsage = $data->getInteger('energyUsage');
        return $this;
    }
}
<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Transfer;

use FactorioItemBrowser\Common\Constant\EnergyUsageUnit;
use FactorioItemBrowser\Common\Constant\EntityType;

/**
 * The entity representing a machine crafting recipes.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Machine extends GenericEntity
{
    public string $type = EntityType::MACHINE;

    /**
     * The crafting speed of the machine.
     * @var float
     */
    public float $craftingSpeed = 0.;

    /**
     * The number of item slots available in the machine.
     * @var int
     */
    public int $numberOfItemSlots = 0;

    /**
     * The number of fluid input slots available in the machine.
     * @var int
     */
    public int $numberOfFluidInputSlots = 0;

    /**
     * The number of fluid output slots available in the machine.
     * @var int
     */
    public int $numberOfFluidOutputSlots = 0;

    /**
     * The number of module slots available in the machine.
     * @var int
     */
    public int $numberOfModuleSlots = 0;

    /**
     * The energy usage of the machine.
     * @var float
     */
    public float $energyUsage = 0.;

    /**
     * The unit of the energy usage.
     * @var string
     */
    public string $energyUsageUnit = EnergyUsageUnit::WATT;
}

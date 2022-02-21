<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Transfer;

use FactorioItemBrowser\Common\Constant\EnergyUsageUnit;
use FactorioItemBrowser\Common\Constant\EntityType;
use JMS\Serializer\Annotation\Type;

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
     * The crafting and resource categories supported by the machine.
     * @var array<Category>
     */
    #[Type('array<' . Category::class . '>')]
    public array $categories = [];

    /**
     * The crafting or mining speed of the machine.
     */
    public float $speed = 0.;

    /**
     * The number of item slots available in the machine.
     */
    public int $numberOfItemSlots = 0;

    /**
     * The number of fluid input slots available in the machine.
     */
    public int $numberOfFluidInputSlots = 0;

    /**
     * The number of fluid output slots available in the machine.
     */
    public int $numberOfFluidOutputSlots = 0;

    /**
     * The number of module slots available in the machine.
     */
    public int $numberOfModuleSlots = 0;

    /**
     * The energy usage of the machine.
     */
    public float $energyUsage = 0.;

    /**
     * The unit of the energy usage.
     */
    public string $energyUsageUnit = EnergyUsageUnit::WATT;
}

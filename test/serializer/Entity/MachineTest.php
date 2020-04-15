<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\Api\Client\Entity;

use FactorioItemBrowser\Api\Client\Entity\Machine;
use FactorioItemBrowserTestSerializer\Api\Client\SerializerTestCase;

/**
 * The PHPUnit test of serializing the Machine class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversNothing
 */
class MachineTest extends SerializerTestCase
{
    /**
     * Returns the object to be serialized or deserialized.
     * @return object
     */
    protected function getObject(): object
    {
        $result = new Machine();
        $result->setName('abc')
               ->setLabel('def')
               ->setDescription('ghi')
               ->setCraftingSpeed(13.37)
               ->setNumberOfItemSlots(12)
               ->setNumberOfFluidInputSlots(23)
               ->setNumberOfFluidOutputSlots(34)
               ->setNumberOfModuleSlots(45)
               ->setEnergyUsage(4.2)
               ->setEnergyUsageUnit('jkl');

        return $result;
    }

    /**
     * Returns the serialized data.
     * @return array<mixed>
     */
    protected function getData(): array
    {
        return [
            'name' => 'abc',
            'label' => 'def',
            'description' => 'ghi',
            'craftingSpeed' => 13.37,
            'numberOfItemSlots' => 12,
            'numberOfFluidInputSlots' => 23,
            'numberOfFluidOutputSlots' => 34,
            'numberOfModuleSlots' => 45,
            'energyUsage' => 4.2,
            'energyUsageUnit' => 'jkl',
        ];
    }
}

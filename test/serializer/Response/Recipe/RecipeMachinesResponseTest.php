<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\Api\Client\Response\Recipe;

use FactorioItemBrowser\Api\Client\Entity\Machine;
use FactorioItemBrowser\Api\Client\Response\Recipe\RecipeMachinesResponse;
use FactorioItemBrowserTestSerializer\Api\Client\SerializerTestCase;

/**
 * The PHPUnit test of serializing the RecipeMachinesResponse class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversNothing
 */
class RecipeMachinesResponseTest extends SerializerTestCase
{
    /**
     * Returns the object to be serialized or deserialized.
     * @return object
     */
    protected function getObject(): object
    {
        $machine1 = new Machine();
        $machine1->setName('abc')
                 ->setLabel('def')
                 ->setDescription('ghi')
                 ->setCraftingSpeed(13.37)
                 ->setNumberOfItemSlots(12)
                 ->setNumberOfFluidInputSlots(23)
                 ->setNumberOfFluidOutputSlots(34)
                 ->setNumberOfModuleSlots(45)
                 ->setEnergyUsage(4.2)
                 ->setEnergyUsageUnit('jkl');

        $machine2 = new Machine();
        $machine2->setName('mno')
                 ->setLabel('pqr')
                 ->setDescription('stu')
                 ->setCraftingSpeed(73.31)
                 ->setNumberOfItemSlots(56)
                 ->setNumberOfFluidInputSlots(67)
                 ->setNumberOfFluidOutputSlots(78)
                 ->setNumberOfModuleSlots(89)
                 ->setEnergyUsage(2.1)
                 ->setEnergyUsageUnit('vwx');

        $result = new RecipeMachinesResponse();
        $result->setMachines([$machine1, $machine2])
               ->setTotalNumberOfResults(42);

        return $result;
    }

    /**
     * Returns the serialized data.
     * @return array<mixed>
     */
    protected function getData(): array
    {
        return [
            'machines' => [
                [
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
                ],
                [
                    'name' => 'mno',
                    'label' => 'pqr',
                    'description' => 'stu',
                    'craftingSpeed' => 73.31,
                    'numberOfItemSlots' => 56,
                    'numberOfFluidInputSlots' => 67,
                    'numberOfFluidOutputSlots' => 78,
                    'numberOfModuleSlots' => 89,
                    'energyUsage' => 2.1,
                    'energyUsageUnit' => 'vwx',
                ],
            ],
            'totalNumberOfResults' => 42,
        ];
    }
}

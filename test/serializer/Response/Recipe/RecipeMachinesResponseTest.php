<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\Api\Client\Response\Recipe;

use FactorioItemBrowser\Api\Client\Transfer\Machine;
use FactorioItemBrowser\Api\Client\Response\Recipe\RecipeMachinesResponse;
use FactorioItemBrowserTestSerializer\Api\Client\SerializerTestCase;

/**
 * The serializer test of the RecipeMachinesResponse class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class RecipeMachinesResponseTest extends SerializerTestCase
{
    public function test(): void
    {
        $machine1 = new Machine();
        $machine1->name = 'abc';
        $machine1->label = 'def';
        $machine1->description = 'ghi';
        $machine1->craftingSpeed = 13.37;
        $machine1->numberOfItemSlots = 12;
        $machine1->numberOfFluidInputSlots = 23;
        $machine1->numberOfFluidOutputSlots = 34;
        $machine1->numberOfModuleSlots = 45;
        $machine1->energyUsage = 4.2;
        $machine1->energyUsageUnit = 'jkl';

        $machine2 = new Machine();
        $machine2->name = 'mno';
        $machine2->label = 'pqr';
        $machine2->description = 'stu';
        $machine2->craftingSpeed = 73.31;
        $machine2->numberOfItemSlots = 56;
        $machine2->numberOfFluidInputSlots = 67;
        $machine2->numberOfFluidOutputSlots = 78;
        $machine2->numberOfModuleSlots = 89;
        $machine2->energyUsage = 2.1;
        $machine2->energyUsageUnit = 'vwx';

        $object = new RecipeMachinesResponse();
        $object->machines = [$machine1, $machine2];
        $object->totalNumberOfResults = 42;

        $data = [
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

        $this->assertSerialization($data, $object);
        $this->assertDeserialization($object, $data);
    }
}

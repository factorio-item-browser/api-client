<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\Api\Client\Transfer;

use FactorioItemBrowser\Api\Client\Transfer\Category;
use FactorioItemBrowser\Api\Client\Transfer\Machine;
use FactorioItemBrowserTestSerializer\Api\Client\SerializerTestCase;

/**
 * The serializer test of the Machine class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class MachineTest extends SerializerTestCase
{
    public function test(): void
    {
        $category1 = new Category();
        $category1->type = 'mno';
        $category1->name = 'pqr';
        $category2 = new Category();
        $category2->type = 'stu';
        $category2->name = 'vwx';

        $object = new Machine();
        $object->name = 'abc';
        $object->label = 'def';
        $object->description = 'ghi';
        $object->categories = [$category1, $category2];
        $object->speed = 13.37;
        $object->numberOfItemSlots = 12;
        $object->numberOfFluidInputSlots = 23;
        $object->numberOfFluidOutputSlots = 34;
        $object->numberOfModuleSlots = 45;
        $object->energyUsage = 4.2;
        $object->energyUsageUnit = 'jkl';

        $data = [
            'name' => 'abc',
            'label' => 'def',
            'description' => 'ghi',
            'categories' => [
                ['type' => 'mno', 'name' => 'pqr'],
                ['type' => 'stu', 'name' => 'vwx'],
            ],
            'speed' => 13.37,
            'numberOfItemSlots' => 12,
            'numberOfFluidInputSlots' => 23,
            'numberOfFluidOutputSlots' => 34,
            'numberOfModuleSlots' => 45,
            'energyUsage' => 4.2,
            'energyUsageUnit' => 'jkl',
        ];

        $this->assertSerialization($data, $object);
        $this->assertDeserialization($object, $data);
    }
}

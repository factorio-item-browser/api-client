<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\Api\Client\Transfer;

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
        $object = new Machine();
        $object->name = 'abc';
        $object->label = 'def';
        $object->description = 'ghi';
        $object->craftingSpeed = 13.37;
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
            'craftingSpeed' => 13.37,
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

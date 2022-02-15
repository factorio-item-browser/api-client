<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\Api\Client\Response\Meta;

use DateTime;
use FactorioItemBrowser\Api\Client\Response\Meta\StatusResponse;
use FactorioItemBrowserTestSerializer\Api\Client\SerializerTestCase;

/**
 * The serializer test of the StatusResponse class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class StatusResponseTest extends SerializerTestCase
{
    public function test(): void
    {
        $object = new StatusResponse();
        $object->dataVersion = 42;
        $object->importTime = new DateTime('2038-01-19T03:14:00+00:00');
        $object->numberOfMods = 12;
        $object->numberOfItems = 23;
        $object->numberOfMachines = 34;
        $object->numberOfRecipes = 45;
        $object->numberOfTechnologies = 56;

        $data = [
            'dataVersion' => 42,
            'importTime' => '2038-01-19T03:14:00+00:00',
            'numberOfMods' => 12,
            'numberOfItems' => 23,
            'numberOfMachines' => 34,
            'numberOfRecipes' => 45,
            'numberOfTechnologies' => 56,
        ];

        $this->assertSerialization($data, $object);
        $this->assertDeserialization($object, $data);
    }
}

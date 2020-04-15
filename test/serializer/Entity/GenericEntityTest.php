<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\Api\Client\Entity;

use FactorioItemBrowser\Api\Client\Entity\GenericEntity;
use FactorioItemBrowserTestSerializer\Api\Client\SerializerTestCase;

/**
 * The PHPUnit test of serializing the GenericEntity class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversNothing
 */
class GenericEntityTest extends SerializerTestCase
{
    /**
     * Returns the object to be serialized or deserialized.
     * @return object
     */
    protected function getObject(): object
    {
        $result = new GenericEntity();
        $result->setType('abc')
               ->setName('def')
               ->setLabel('ghi')
               ->setDescription('jkl');

        return $result;
    }

    /**
     * Returns the serialized data.
     * @return array<mixed>
     */
    protected function getData(): array
    {
        return [
            'type' => 'abc',
            'name' => 'def',
            'label' => 'ghi',
            'description' => 'jkl',
        ];
    }
}

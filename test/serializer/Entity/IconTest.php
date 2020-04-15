<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\Api\Client\Entity;

use FactorioItemBrowser\Api\Client\Entity\Entity;
use FactorioItemBrowser\Api\Client\Entity\Icon;
use FactorioItemBrowserTestSerializer\Api\Client\SerializerTestCase;

/**
 * The PHPUnit test of serializing the Icon class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversNothing
 */
class IconTest extends SerializerTestCase
{
    /**
     * Returns the object to be serialized or deserialized.
     * @return object
     */
    protected function getObject(): object
    {
        $entity1 = new Entity();
        $entity1->setType('abc')
                ->setName('def');

        $entity2 = new Entity();
        $entity2->setType('ghi')
                ->setName('jkl');

        $result = new Icon();
        $result->setEntities([$entity1, $entity2])
               ->setContent('mno')
               ->setSize(42);

        return $result;
    }

    /**
     * Returns the serialized data.
     * @return array<mixed>
     */
    protected function getData(): array
    {
        return [
            'entities' => [
                [
                    'type' => 'abc',
                    'name' => 'def',
                ],
                [
                    'type' => 'ghi',
                    'name' => 'jkl',
                ],
            ],
            'content' => 'bW5v',
            'size' => 42,
        ];
    }
}

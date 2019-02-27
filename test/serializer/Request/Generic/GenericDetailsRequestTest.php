<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\Api\Client\Request\Generic;

use FactorioItemBrowser\Api\Client\Entity\RequestEntity;
use FactorioItemBrowser\Api\Client\Request\Generic\GenericDetailsRequest;
use FactorioItemBrowserTestAsset\Api\Client\SerializerTestCase;

/**
 * The PHPUnit test of serializing the GenericDetailsRequest class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversNothing
 */
class GenericDetailsRequestTest extends SerializerTestCase
{
    /**
     * Returns the object to be serialized or deserialized.
     * @return object
     */
    protected function getObject(): object
    {
        $entity1 = new RequestEntity();
        $entity1->setType('abc')
                ->setName('def');

        $entity2 = new RequestEntity();
        $entity2->setType('ghi')
                ->setName('jkl');

        $result = new GenericDetailsRequest();
        $result->setEntities([$entity1, $entity2]);
        return $result;
    }

    /**
     * Returns the serialized data.
     * @return array
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
            ]
        ];
    }
}

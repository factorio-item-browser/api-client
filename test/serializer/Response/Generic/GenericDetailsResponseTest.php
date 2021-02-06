<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\Api\Client\Response\Generic;

use FactorioItemBrowser\Api\Client\Transfer\GenericEntity;
use FactorioItemBrowser\Api\Client\Response\Generic\GenericDetailsResponse;
use FactorioItemBrowserTestSerializer\Api\Client\SerializerTestCase;

/**
 * The serializer test of the GenericDetailsResponse class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class GenericDetailsResponseTest extends SerializerTestCase
{
    protected function getObject(): object
    {
        $entity1 = new GenericEntity();
        $entity1->type = 'abc';
        $entity1->name = 'def';
        $entity1->label = 'ghi';
        $entity1->description = 'jkl';

        $entity2 = new GenericEntity();
        $entity2->type = 'mno';
        $entity2->name = 'pqr';
        $entity2->label = 'stu';
        $entity2->description = 'vwx';

        $object = new GenericDetailsResponse();
        $object->entities = [$entity1, $entity2];

        return $object;
    }

    protected function getData(): array
    {
        return [
            'entities' => [
                [
                    'type' => 'abc',
                    'name' => 'def',
                    'label' => 'ghi',
                    'description' => 'jkl',
                ],
                [
                    'type' => 'mno',
                    'name' => 'pqr',
                    'label' => 'stu',
                    'description' => 'vwx',
                ],
            ],
        ];
    }
}

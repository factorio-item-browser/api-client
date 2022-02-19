<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\Api\Client\Request\Recipe;

use FactorioItemBrowser\Api\Client\Request\Recipe\RecipeDetailsRequest;
use FactorioItemBrowser\Api\Client\Transfer\Entity;
use FactorioItemBrowserTestSerializer\Api\Client\SerializerTestCase;

/**
 * The serializer test of the RecipeDetailsRequest class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class RecipeDetailsRequestTest extends SerializerTestCase
{
    public function test(): void
    {
        $entity1 = new Entity();
        $entity1->type = 'abc';
        $entity1->name = 'def';
        $entity2 = new Entity();
        $entity2->type = 'ghi';
        $entity2->name = 'jkl';

        $object = new RecipeDetailsRequest();
        $object->recipes = [$entity1, $entity2];
        $object->names = ['mno', 'pqr'];

        $data = [
            'recipes' => [
                ['type' => 'abc', 'name' => 'def'],
                ['type' => 'ghi', 'name' => 'jkl'],
            ],
            'names' => ['mno', 'pqr'],
        ];

        $this->assertSerialization($data, $object);
        $this->assertDeserialization($object, $data);
    }
}

<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\Api\Client\Response\Item;

use FactorioItemBrowser\Api\Client\Transfer\GenericEntityWithRecipes;
use FactorioItemBrowser\Api\Client\Response\Item\ItemIngredientResponse;
use FactorioItemBrowserTestSerializer\Api\Client\SerializerTestCase;

/**
 * The serializer test of the ItemIngredientResponse class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ItemIngredientResponseTest extends SerializerTestCase
{
    protected function getObject(): object
    {
        $entity = new GenericEntityWithRecipes();
        $entity->type = 'abc';
        $entity->name = 'def';
        $entity->label = 'ghi';
        $entity->description = 'jkl';
        $entity->totalNumberOfRecipes = 42;

        $object = new ItemIngredientResponse();
        $object->item = $entity;

        return $object;
    }

    protected function getData(): array
    {
        return [
            'item' => [
                'type' => 'abc',
                'name' => 'def',
                'label' => 'ghi',
                'description' => 'jkl',
                'recipes' => [],
                'totalNumberOfRecipes' => 42,
            ],
        ];
    }
}

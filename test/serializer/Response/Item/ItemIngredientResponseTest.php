<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\Api\Client\Response\Item;

use FactorioItemBrowser\Api\Client\Entity\GenericEntityWithRecipes;
use FactorioItemBrowser\Api\Client\Response\Item\ItemIngredientResponse;
use FactorioItemBrowserTestAsset\Api\Client\SerializerTestCase;

/**
 * The PHPUnit test of serializing the ItemIngredientResponse class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversNothing
 */
class ItemIngredientResponseTest extends SerializerTestCase
{
    /**
     * Returns the object to be serialized or deserialized.
     * @return object
     */
    protected function getObject(): object
    {
        $entity = new GenericEntityWithRecipes();
        $entity->setType('abc')
               ->setName('def')
               ->setLabel('ghi')
               ->setDescription('jkl')
               ->setTotalNumberOfRecipes(42);

        $result = new ItemIngredientResponse();
        $result->setItem($entity);

        return $result;
    }

    /**
     * Returns the serialized data.
     * @return array<mixed>
     */
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

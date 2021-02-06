<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\Api\Client\Request\Recipe;

use FactorioItemBrowser\Api\Client\Request\Recipe\RecipeDetailsRequest;
use FactorioItemBrowserTestSerializer\Api\Client\SerializerTestCase;

/**
 * The serializer test of the RecipeDetailsRequest class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class RecipeDetailsRequestTest extends SerializerTestCase
{
    protected function getObject(): object
    {
        $object = new RecipeDetailsRequest();
        $object->names = ['abc', 'def'];

        return $object;
    }

    protected function getData(): array
    {
        return [
            'names' => ['abc', 'def'],
        ];
    }
}

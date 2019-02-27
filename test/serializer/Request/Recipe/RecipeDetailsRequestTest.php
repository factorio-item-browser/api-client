<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\Api\Client\Request\Recipe;

use FactorioItemBrowser\Api\Client\Request\Recipe\RecipeDetailsRequest;
use FactorioItemBrowserTestAsset\Api\Client\SerializerTestCase;

/**
 * The PHPUnit test of serializing the RecipeDetailsRequest class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversNothing
 */
class RecipeDetailsRequestTest extends SerializerTestCase
{
    /**
     * Returns the object to be serialized or deserialized.
     * @return object
     */
    protected function getObject(): object
    {
        $result = new RecipeDetailsRequest();
        $result->setNames(['abc', 'def']);
        return $result;
    }

    /**
     * Returns the serialized data.
     * @return array
     */
    protected function getData(): array
    {
        return [
            'names' => ['abc', 'def'],
        ];
    }
}

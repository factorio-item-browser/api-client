<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\Api\Client\Request\Auth;

use FactorioItemBrowser\Api\Client\Entity\Item;
use FactorioItemBrowserTestAsset\Api\Client\SerializerTestCase;

/**
 * The PHPUnit test of serializing the Item class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversNothing
 */
class ItemTest extends SerializerTestCase
{
    /**
     * Returns the object to be serialized or deserialized.
     * @return object
     */
    protected function getObject(): object
    {
        $result = new Item();
        $result->setType('abc')
               ->setName('def')
               ->setLabel('ghi')
               ->setDescription('jkl')
               ->setAmount(13.37);
        return $result;
    }

    /**
     * Returns the serialized data.
     * @return array
     */
    protected function getData(): array
    {
        return [
            'type' => 'abc',
            'name' => 'def',
            'label'=> 'ghi',
            'description' => 'jkl',
            'amount' => 13.37,
        ];
    }
}

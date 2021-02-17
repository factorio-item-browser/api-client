<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\Api\Client\Transfer;

use FactorioItemBrowser\Api\Client\Transfer\Mod;
use FactorioItemBrowserTestSerializer\Api\Client\SerializerTestCase;

/**
 * The serializer test of the Mod class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ModTest extends SerializerTestCase
{
    protected function getObject(): object
    {
        $object = new Mod();
        $object->name = 'abc';
        $object->label = 'def';
        $object->description = 'ghi';
        $object->author = 'jkl';
        $object->version = '1.2.3';

        return $object;
    }

    protected function getData(): array
    {
        return [
            'name' => 'abc',
            'label' => 'def',
            'description' => 'ghi',
            'author' => 'jkl',
            'version' => '1.2.3',
        ];
    }
}

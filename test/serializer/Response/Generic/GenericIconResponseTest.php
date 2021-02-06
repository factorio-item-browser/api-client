<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\Api\Client\Response\Generic;

use FactorioItemBrowser\Api\Client\Transfer\Icon;
use FactorioItemBrowser\Api\Client\Response\Generic\GenericIconResponse;
use FactorioItemBrowserTestSerializer\Api\Client\SerializerTestCase;

/**
 * The serializer test of the GenericIconResponse class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class GenericIconResponseTest extends SerializerTestCase
{
    protected function getObject(): object
    {
        $icon1 = new Icon();
        $icon1->content = 'abc';
        $icon1->size = 42;

        $icon2 = new Icon();
        $icon2->content = 'def';
        $icon2->size = 1337;

        $object = new GenericIconResponse();
        $object->icons = [$icon1, $icon2];

        return $object;
    }

    protected function getData(): array
    {
        return [
            'icons' => [
                [
                    'entities' => [],
                    'content' => 'YWJj',
                    'size' => 42,
                ],
                [
                    'entities' => [],
                    'content' => 'ZGVm',
                    'size' => 1337,
                ],
            ],
        ];
    }
}

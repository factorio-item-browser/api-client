<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\Api\Client\Response\Generic;

use FactorioItemBrowser\Api\Client\Entity\Icon;
use FactorioItemBrowser\Api\Client\Response\Generic\GenericIconResponse;
use FactorioItemBrowserTestAsset\Api\Client\SerializerTestCase;

/**
 * The PHPUnit test of serializing the GenericIconResponse class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversNothing
 */
class GenericIconResponseTest extends SerializerTestCase
{
    /**
     * Returns the object to be serialized or deserialized.
     * @return object
     */
    protected function getObject(): object
    {
        $icon1 = new Icon();
        $icon1->setContent('abc');

        $icon2 = new Icon();
        $icon2->setContent('def');

        $result = new GenericIconResponse();
        $result->setIcons([$icon1, $icon2]);

        return $result;
    }

    /**
     * Returns the serialized data.
     * @return array
     */
    protected function getData(): array
    {
        return [
            'icons' => [
                [
                    'entities' => [],
                    'content' => 'YWJj',
                ],
                [
                    'entities' => [],
                    'content' => 'ZGVm',
                ],
            ],
        ];
    }
}

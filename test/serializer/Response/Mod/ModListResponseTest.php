<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\Api\Client\Response\Mod;

use FactorioItemBrowser\Api\Client\Transfer\Mod;
use FactorioItemBrowser\Api\Client\Response\Mod\ModListResponse;
use FactorioItemBrowserTestSerializer\Api\Client\SerializerTestCase;

/**
 * The serializer test of the ModListResponse class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversNothing
 */
class ModListResponseTest extends SerializerTestCase
{
    public function test(): void
    {
        $mod1 = new Mod();
        $mod1->name = 'abc';
        $mod1->label = 'def';
        $mod1->description = 'ghi';
        $mod1->author = 'jkl';
        $mod1->version = '1.2.3';

        $mod2 = new Mod();
        $mod2->name = 'mno';
        $mod2->label = 'pqr';
        $mod2->description = 'stu';
        $mod2->author = 'vwx';
        $mod2->version = '4.5.6';

        $object = new ModListResponse();
        $object->mods = [$mod1, $mod2];

        $data = [
            'mods' => [
                [
                    'name' => 'abc',
                    'label' => 'def',
                    'description' => 'ghi',
                    'author' => 'jkl',
                    'version' => '1.2.3',
                ],
                [
                    'name' => 'mno',
                    'label' => 'pqr',
                    'description' => 'stu',
                    'author' => 'vwx',
                    'version' => '4.5.6',
                ],
            ],
        ];

        $this->assertSerialization($data, $object);
        $this->assertDeserialization($object, $data);
    }
}

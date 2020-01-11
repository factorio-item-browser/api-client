<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\Api\Client\Response\Mod;

use FactorioItemBrowser\Api\Client\Entity\Mod;
use FactorioItemBrowser\Api\Client\Response\Mod\ModListResponse;
use FactorioItemBrowserTestAsset\Api\Client\SerializerTestCase;

/**
 * The PHPUnit test of serializing the ModListResponse class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversNothing
 */
class ModListResponseTest extends SerializerTestCase
{
    /**
     * Returns the object to be serialized or deserialized.
     * @return object
     */
    protected function getObject(): object
    {
        $mod1 = new Mod();
        $mod1->setName('abc')
             ->setLabel('def')
             ->setDescription('ghi')
             ->setAuthor('jkl')
             ->setVersion('1.2.3')
             ->setIsEnabled(true);

        $mod2 = new Mod();
        $mod2->setName('mno')
             ->setLabel('pqr')
             ->setDescription('stu')
             ->setAuthor('vwx')
             ->setVersion('4.5.6')
             ->setIsEnabled(false);


        $result = new ModListResponse();
        $result->setMods([$mod1, $mod2]);

        return $result;
    }

    /**
     * Returns the serialized data.
     * @return array<mixed>
     */
    protected function getData(): array
    {
        return [
            'mods' => [
                [
                    'name' => 'abc',
                    'label' => 'def',
                    'description' => 'ghi',
                    'author' => 'jkl',
                    'version' => '1.2.3',
                    'isEnabled' => true,
                ],
                [
                    'name' => 'mno',
                    'label' => 'pqr',
                    'description' => 'stu',
                    'author' => 'vwx',
                    'version' => '4.5.6',
                    'isEnabled' => false,
                ],
            ]
        ];
    }
}

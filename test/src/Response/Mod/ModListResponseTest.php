<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Response\Mod;

use FactorioItemBrowser\Api\Client\Entity\Mod;
use FactorioItemBrowser\Api\Client\Response\Mod\ModListResponse;
use FactorioItemBrowserTestAsset\Api\Client\Response\TestPendingResponse;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the mod list response class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Response\Mod\ModListResponse
 */
class ModListResponseTest extends TestCase
{
    /**
     * Tests mapping and getting the mods.
     * @covers ::getMods
     * @covers ::mapResponse
     */
    public function testGetMods()
    {
        $responseData = [
            'mods' => [
                ['name' => 'abc'],
                ['name' => 'def']
            ]
        ];
        $mod1 = new Mod();
        $mod1->setName('abc');
        $mod2 = new Mod();
        $mod2->setName('def');

        $response = new ModListResponse(new TestPendingResponse($responseData));
        $this->assertEquals([$mod1, $mod2], $response->getMods());
    }
}

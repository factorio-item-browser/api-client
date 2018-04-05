<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Response\Mod;

use FactorioItemBrowser\Api\Client\Entity\Meta;
use FactorioItemBrowser\Api\Client\Response\Mod\ModMetaResponse;
use FactorioItemBrowserTestAsset\Api\Client\Response\TestPendingResponse;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the mod meta response class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Response\Mod\ModMetaResponse
 */
class ModMetaResponseTest extends TestCase
{
    /**
     * Tests getting the number of available mods.
     * @covers ::getNumberOfAvailableMods
     * @covers ::mapResponse
     */
    public function testGetNumberOfAvailableMods()
    {
        $responseData = [
            'numberOfAvailableMods' => 42
        ];

        $response = new ModMetaResponse(new TestPendingResponse($responseData));
        $this->assertEquals(42, $response->getNumberOfAvailableMods());
    }

    /**
     * Tests getting the number of enabled mods.
     * @covers ::getNumberOfEnabledMods
     * @covers ::mapResponse
     */
    public function testGetNumberOfEnabledMods()
    {
        $responseData = [
            'numberOfEnabledMods' => 42
        ];

        $response = new ModMetaResponse(new TestPendingResponse($responseData));
        $this->assertEquals(42, $response->getNumberOfEnabledMods());
    }
    
    /**
     * Tests mapping and getting the meta data.
     * @coversNothing
     */
    public function testGetMeta()
    {
        $responseData = [
            'meta' => [
                'executionTime' => 13.37
            ]
        ];
        $expectedMeta = new Meta();
        $expectedMeta->setExecutionTime(13.37);

        $response = new ModMetaResponse(new TestPendingResponse($responseData));
        $this->assertEquals($expectedMeta, $response->getMeta());
    }
}

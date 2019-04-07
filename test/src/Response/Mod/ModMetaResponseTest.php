<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Response\Mod;

use FactorioItemBrowser\Api\Client\Response\Mod\ModMetaResponse;
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
     * Tests the constructing.
     * @coversNothing
     */
    public function testConstruct(): void
    {
        $response = new ModMetaResponse();

        $this->assertSame(0, $response->getNumberOfAvailableMods());
        $this->assertSame(0, $response->getNumberOfEnabledMods());
    }

    /**
     * Tests the setting and getting the number of available mods.
     * @covers ::getNumberOfAvailableMods
     * @covers ::setNumberOfAvailableMods
     */
    public function testSetAndGetNumberOfAvailableMods(): void
    {
        $numberOfAvailableMods = 42;
        $response = new ModMetaResponse();

        $this->assertSame($response, $response->setNumberOfAvailableMods($numberOfAvailableMods));
        $this->assertSame($numberOfAvailableMods, $response->getNumberOfAvailableMods());
    }

    /**
     * Tests the setting and getting the number of enabled mods.
     * @covers ::getNumberOfEnabledMods
     * @covers ::setNumberOfEnabledMods
     */
    public function testSetAndGetNumberOfEnabledMods(): void
    {
        $numberOfEnabledMods = 42;
        $response = new ModMetaResponse();

        $this->assertSame($response, $response->setNumberOfEnabledMods($numberOfEnabledMods));
        $this->assertSame($numberOfEnabledMods, $response->getNumberOfEnabledMods());
    }
}

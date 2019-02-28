<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Response\Mod;

use FactorioItemBrowser\Api\Client\Entity\Mod;
use FactorioItemBrowser\Api\Client\Response\Mod\ModListResponse;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use ReflectionException;

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
     * Tests the constructing.
     * @coversNothing
     */
    public function testConstruct(): void
    {
        $response = new ModListResponse();

        $this->assertSame([], $response->getMods());
    }

    /**
     * Tests setting, adding and getting the mods.
     * @throws ReflectionException
     * @covers ::addMod
     * @covers ::setMods
     * @covers ::getMods
     */
    public function testSetAddAndGetMods(): void
    {
        /* @var Mod&MockObject $mod1 */
        $mod1 = $this->createMock(Mod::class);
        /* @var Mod&MockObject $mod2 */
        $mod2 = $this->createMock(Mod::class);
        /* @var Mod&MockObject $mod3 */
        $mod3 = $this->createMock(Mod::class);

        $response = new ModListResponse();
        $this->assertSame($response, $response->setMods([$mod1, $mod2]));
        $this->assertSame([$mod1, $mod2], $response->getMods());

        $this->assertSame($response, $response->addMod($mod3));
        $this->assertSame([$mod1, $mod2, $mod3], $response->getMods());
    }
}

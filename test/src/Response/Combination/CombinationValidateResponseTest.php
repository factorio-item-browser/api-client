<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Response\Combination;

use FactorioItemBrowser\Api\Client\Entity\ValidatedMod;
use FactorioItemBrowser\Api\Client\Response\Combination\CombinationValidateResponse;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the CombinationValidateResponse class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Response\Combination\CombinationValidateResponse
 */
class CombinationValidateResponseTest extends TestCase
{
    /**
     * Tests the setting and getting the is valid.
     * @covers ::getIsValid
     * @covers ::setIsValid
     */
    public function testSetAndGetIsValid(): void
    {
        $response = new CombinationValidateResponse();

        $this->assertSame($response, $response->setIsValid(true));
        $this->assertTrue($response->getIsValid());
    }

    /**
     * Tests setting, adding and getting the mods.
     * @covers ::addValidatedMod
     * @covers ::setValidatedMods
     * @covers ::getValidatedMods
     */
    public function testSetAddAndGetMods(): void
    {
        $mod1 = $this->createMock(ValidatedMod::class);
        $mod2 = $this->createMock(ValidatedMod::class);
        $mod3 = $this->createMock(ValidatedMod::class);

        $response = new CombinationValidateResponse();
        $this->assertSame($response, $response->setValidatedMods([$mod1, $mod2]));
        $this->assertSame([$mod1, $mod2], $response->getValidatedMods());

        $this->assertSame($response, $response->addValidatedMod($mod3));
        $this->assertSame([$mod1, $mod2, $mod3], $response->getValidatedMods());
    }
}

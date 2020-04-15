<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Response\Generic;

use FactorioItemBrowser\Api\Client\Entity\Icon;
use FactorioItemBrowser\Api\Client\Response\Generic\GenericIconResponse;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the generic icon response class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Response\Generic\GenericIconResponse
 */
class GenericIconResponseTest extends TestCase
{
    /**
     * Tests the constructing.
     * @coversNothing
     */
    public function testConstruct(): void
    {
        $response = new GenericIconResponse();

        $this->assertSame([], $response->getIcons());
    }

    /**
     * Tests setting, adding and getting the icons.
     * @covers ::addIcon
     * @covers ::setIcons
     * @covers ::getIcons
     */
    public function testSetAddAndGetIcons(): void
    {
        /* @var Icon&MockObject $icon1 */
        $icon1 = $this->createMock(Icon::class);
        /* @var Icon&MockObject $icon2 */
        $icon2 = $this->createMock(Icon::class);
        /* @var Icon&MockObject $icon3 */
        $icon3 = $this->createMock(Icon::class);

        $response = new GenericIconResponse();
        $this->assertSame($response, $response->setIcons([$icon1, $icon2]));
        $this->assertSame([$icon1, $icon2], $response->getIcons());

        $this->assertSame($response, $response->addIcon($icon3));
        $this->assertSame([$icon1, $icon2, $icon3], $response->getIcons());
    }
}

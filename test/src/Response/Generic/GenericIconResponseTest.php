<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Response\Generic;

use FactorioItemBrowser\Api\Client\Entity\Icon;
use FactorioItemBrowser\Api\Client\Entity\Meta;
use FactorioItemBrowser\Api\Client\Response\Generic\GenericIconResponse;
use FactorioItemBrowserTestAsset\Api\Client\Response\TestPendingResponse;
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
     * Tests mapping and getting the icons.
     * @covers ::getIcons
     * @covers ::mapResponse
     */
    public function testGetIcons()
    {
        $responseData = [
            'icons' => [
                ['content' => 'abc'],
                ['content' => 'def']
            ]
        ];
        $icon1 = new Icon();
        $icon1->setContent('abc');
        $icon2 = new Icon();
        $icon2->setContent('def');

        $response = new GenericIconResponse(new TestPendingResponse($responseData));
        $this->assertEquals([$icon1, $icon2], $response->getIcons());
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

        $response = new GenericIconResponse(new TestPendingResponse($responseData));
        $this->assertEquals($expectedMeta, $response->getMeta());
    }
}

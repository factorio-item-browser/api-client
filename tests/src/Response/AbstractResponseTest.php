<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Response;

use FactorioItemBrowser\Api\Client\Entity\Meta;
use FactorioItemBrowser\Api\Client\Response\AbstractResponse;
use FactorioItemBrowserTestAsset\Api\Client\Response\TestPendingResponse;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the abstract response class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass FactorioItemBrowser\Api\Client\Response\AbstractResponse
 */
class AbstractResponseTest extends TestCase
{
    /**
     * Tests mapping and getting the meta data.
     * @covers ::__construct
     * @covers ::getMeta
     * @covers ::checkResponse
     * @covers ::mapResponse
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

        /* @var AbstractResponse|MockObject $response */
        $response = $this->getMockBuilder(AbstractResponse::class)
                         ->setConstructorArgs([new TestPendingResponse($responseData)])
                         ->getMockForAbstractClass();

        $this->assertEquals($expectedMeta, $response->getMeta());
    }
}

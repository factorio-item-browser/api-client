<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Response;

use BluePsyduck\Common\Data\DataContainer;
use BluePsyduck\Common\Test\ReflectionTrait;
use FactorioItemBrowser\Api\Client\Response\AbstractResponse;
use FactorioItemBrowserTestAsset\Api\Client\Response\TestPendingResponse;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the abstract response class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Response\AbstractResponse
 */
class AbstractResponseTest extends TestCase
{
    use ReflectionTrait;

    /**
     * Tests checking the pending response.
     * @covers ::__construct
     * @covers ::checkPendingResponse
     */
    public function testCheckPendingResponse()
    {
        $responseData = [
            'foo' => 'bar'
        ];

        /* @var AbstractResponse|MockObject $response */
        $response = $this->getMockBuilder(AbstractResponse::class)
                         ->setMethods(['mapResponse'])
                         ->setConstructorArgs([new TestPendingResponse($responseData)])
                         ->getMockForAbstractClass();
        $response->expects($this->once())
                 ->method('mapResponse')
                 ->with(new DataContainer($responseData));

        $this->assertSame($response, $this->invokeMethod($response, 'checkPendingResponse'));
    }
}

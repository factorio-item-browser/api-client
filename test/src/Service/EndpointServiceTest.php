<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Service;

use BluePsyduck\Common\Test\ReflectionTrait;
use FactorioItemBrowser\Api\Client\Endpoint\EndpointInterface;
use FactorioItemBrowser\Api\Client\Service\EndpointService;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * The PHPUnit test of the EndpointService class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Service\EndpointService
 */
class EndpointServiceTest extends TestCase
{
    use ReflectionTrait;

    /**
     * Tests the constructing.
     * @throws ReflectionException
     * @covers ::__construct
     */
    public function testConstruct(): void
    {
        /* @var EndpointInterface&MockObject $endpoint1 */
        $endpoint1 = $this->createMock(EndpointInterface::class);
        $endpoint1->expects($this->once())
                  ->method('getSupportedRequestClass')
                  ->willReturn('abc');

        /* @var EndpointInterface&MockObject $endpoint2 */
        $endpoint2 = $this->createMock(EndpointInterface::class);
        $endpoint2->expects($this->once())
                  ->method('getSupportedRequestClass')
                  ->willReturn('def');

        $endpoints = [$endpoint1, $endpoint2];
        $expectedEndpoints = [
            'abc' => $endpoint1,
            'def' => $endpoint2,
        ];

        $service = new EndpointService($endpoints);

        $this->assertEquals($expectedEndpoints, $this->extractProperty($service, 'endpointsByRequestClass'));
    }
}

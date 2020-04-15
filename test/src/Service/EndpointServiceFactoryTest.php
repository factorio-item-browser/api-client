<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Service;

use BluePsyduck\TestHelper\ReflectionTrait;
use FactorioItemBrowser\Api\Client\Constant\ConfigKey;
use FactorioItemBrowser\Api\Client\Endpoint\EndpointInterface;
use FactorioItemBrowser\Api\Client\Service\EndpointService;
use FactorioItemBrowser\Api\Client\Service\EndpointServiceFactory;
use Interop\Container\ContainerInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * The PHPUnit test of the EndpointServiceFactory class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Service\EndpointServiceFactory
 */
class EndpointServiceFactoryTest extends TestCase
{
    use ReflectionTrait;

    /**
     * Tests the invoking.
     * @covers ::__invoke
     */
    public function testInvoke(): void
    {
        $endpointAliases = ['abc', 'def'];
        $config = [
            ConfigKey::PROJECT => [
                ConfigKey::API_CLIENT => [
                    ConfigKey::ENDPOINTS => $endpointAliases,
                ],
            ],
        ];

        /* @var EndpointInterface&MockObject $endpoint1 */
        $endpoint1 = $this->createMock(EndpointInterface::class);
        /* @var EndpointInterface&MockObject $endpoint2 */
        $endpoint2 = $this->createMock(EndpointInterface::class);

        $endpoints = [$endpoint1, $endpoint2];

        /* @var ContainerInterface&MockObject $container */
        $container = $this->createMock(ContainerInterface::class);
        $container->expects($this->once())
                  ->method('get')
                  ->with($this->identicalTo('config'))
                  ->willReturn($config);

        /* @var EndpointServiceFactory&MockObject $factory */
        $factory = $this->getMockBuilder(EndpointServiceFactory::class)
                        ->onlyMethods(['createEndpoints'])
                        ->getMock();
        $factory->expects($this->once())
                ->method('createEndpoints')
                ->with($this->identicalTo($container), $this->identicalTo($endpointAliases))
                ->willReturn($endpoints);

        $factory($container, EndpointService::class);
    }

    /**
     * Tests the createEndpoints method.
     * @throws ReflectionException
     * @covers ::createEndpoints
     */
    public function testCreateEndpoints(): void
    {
        $aliases = ['abc', 'def'];

        /* @var EndpointInterface&MockObject $endpoint1 */
        $endpoint1 = $this->createMock(EndpointInterface::class);
        /* @var EndpointInterface&MockObject $endpoint2 */
        $endpoint2 = $this->createMock(EndpointInterface::class);

        $expectedResult = [$endpoint1, $endpoint2];

        /* @var ContainerInterface&MockObject $container */
        $container = $this->createMock(ContainerInterface::class);
        $container->expects($this->exactly(2))
                  ->method('get')
                  ->withConsecutive(
                      [$this->identicalTo('abc')],
                      [$this->identicalTo('def')]
                  )
                  ->willReturnOnConsecutiveCalls(
                      $endpoint1,
                      $endpoint2
                  );

        $factory = new EndpointServiceFactory();
        $result = $this->invokeMethod($factory, 'createEndpoints', $container, $aliases);

        $this->assertEquals($expectedResult, $result);
    }
}

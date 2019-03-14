<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Client;

use FactorioItemBrowser\Api\Client\Client\Options;
use FactorioItemBrowser\Api\Client\Client\OptionsFactory;
use FactorioItemBrowser\Api\Client\Constant\ConfigKey;
use Interop\Container\ContainerInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * The PHPUnit test of the OptionsFactory class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Client\OptionsFactory
 */
class OptionsFactoryTest extends TestCase
{
    /**
     * Tests the invoking.
     * @throws ReflectionException
     * @covers ::__invoke
     */
    public function testInvoke(): void
    {
        $config = [
            ConfigKey::PROJECT => [
                ConfigKey::API_CLIENT => [
                    ConfigKey::OPTIONS => [
                        ConfigKey::OPTION_API_URL => 'abc',
                        ConfigKey::OPTION_AGENT => 'def',
                        ConfigKey::OPTION_ACCESS_KEY => 'ghi',
                        ConfigKey::OPTION_TIMEOUT => 42,
                    ],
                ],
            ],
        ];

        $expectedResult = new Options();
        $expectedResult->setApiUrl('abc')
                       ->setAgent('def')
                       ->setAccessKey('ghi')
                       ->setTimeout(42);

        /* @var ContainerInterface&MockObject $container */
        $container = $this->createMock(ContainerInterface::class);
        $container->expects($this->once())
                  ->method('get')
                  ->with($this->identicalTo('config'))
                  ->willReturn($config);

        $factory = new OptionsFactory();
        $result = $factory($container, Options::class);

        $this->assertEquals($expectedResult, $result);
    }
}

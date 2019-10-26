<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Serializer;

use BluePsyduck\TestHelper\ReflectionTrait;
use FactorioItemBrowser\Api\Client\Constant\ConfigKey;
use FactorioItemBrowser\Api\Client\Serializer\ContextFactory;
use FactorioItemBrowser\Api\Client\Serializer\Handler\Base64Handler;
use FactorioItemBrowser\Api\Client\Serializer\SerializerFactory;
use Interop\Container\ContainerInterface;
use JMS\Serializer\Handler\HandlerRegistry;
use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * The PHPUnit test of the SerializerFactory class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Serializer\SerializerFactory
 */
class SerializerFactoryTest extends TestCase
{
    use ReflectionTrait;

    /**
     * Tests the invoking.
     * @throws ReflectionException
     * @covers ::__invoke
     */
    public function testInvoke(): void
    {
        $builder = SerializerBuilder::create();
        $builder
            ->addMetadataDir(
                (string) realpath(__DIR__ . '/../../../config/serializer'),
                'FactorioItemBrowser\Api\Client'
            )
            ->setPropertyNamingStrategy(new IdenticalPropertyNamingStrategy())
            ->setSerializationContextFactory(new ContextFactory())
            ->addDefaultHandlers()
            ->configureHandlers(function (HandlerRegistry $registry): void {
                $registry->registerSubscribingHandler(new Base64Handler());
            });

        $expectedResult = $builder->build();

        /* @var ContainerInterface&MockObject $container */
        $container = $this->createMock(ContainerInterface::class);

        /* @var SerializerFactory&MockObject $factory */
        $factory = $this->getMockBuilder(SerializerFactory::class)
                        ->onlyMethods(['addCacheDirectory'])
                        ->getMock();
        $factory->expects($this->once())
                ->method('addCacheDirectory')
                ->with($this->identicalTo($container));

        $result = $factory($container, SerializerInterface::class);

        $this->assertEquals($expectedResult, $result);
    }

    /**
     * Tests the addCacheDirectory method.
     * @throws ReflectionException
     * @covers ::addCacheDirectory
     */
    public function testAddCacheDirectory(): void
    {
        $cacheDir = 'test/log';
        $config = [
            ConfigKey::PROJECT => [
                ConfigKey::API_CLIENT => [
                    ConfigKey::CACHE_DIR => $cacheDir,
                ],
            ],
        ];

        /* @var ContainerInterface&MockObject $container */
        $container = $this->createMock(ContainerInterface::class);
        $container->expects($this->once())
                  ->method('get')
                  ->with($this->identicalTo('config'))
                  ->willReturn($config);

        $serializerBuilder = new SerializerBuilder();
        $expectedSerializerBuilder = clone $serializerBuilder;
        $expectedSerializerBuilder->setCacheDir($cacheDir);

        $factory = new SerializerFactory();
        $this->invokeMethod($factory, 'addCacheDirectory', $container, $serializerBuilder);

        $this->assertEquals($expectedSerializerBuilder, $serializerBuilder);
    }

    /**
     * Tests the addCacheDirectory method without a proper config value.
     * @throws ReflectionException
     * @covers ::addCacheDirectory
     */
    public function testAddCacheDirectoryWithoutConfig(): void
    {
        $config = [];

        /* @var ContainerInterface&MockObject $container */
        $container = $this->createMock(ContainerInterface::class);
        $container->expects($this->once())
                  ->method('get')
                  ->with($this->identicalTo('config'))
                  ->willReturn($config);

        $serializerBuilder = new SerializerBuilder();
        $expectedSerializerBuilder = clone $serializerBuilder;

        $factory = new SerializerFactory();
        $this->invokeMethod($factory, 'addCacheDirectory', $container, $serializerBuilder);

        $this->assertEquals($expectedSerializerBuilder, $serializerBuilder);
    }
}

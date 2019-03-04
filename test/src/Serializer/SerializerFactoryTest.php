<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Serializer;

use FactorioItemBrowser\Api\Client\Serializer\ContextFactory;
use FactorioItemBrowser\Api\Client\Serializer\SerializerFactory;
use Interop\Container\ContainerInterface;
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
            ->setSerializationContextFactory(new ContextFactory());

        $expectedResult = $builder->build();

        /* @var ContainerInterface&MockObject $container */
        $container = $this->createMock(ContainerInterface::class);

        $factory = new SerializerFactory();
        $result = $factory($container, SerializerInterface::class);

        $this->assertEquals($expectedResult, $result);
    }
}

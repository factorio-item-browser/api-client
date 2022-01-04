<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\Api\Client;

use BluePsyduck\JmsSerializerFactory\JmsSerializerFactory;
use FactorioItemBrowser\Api\Client\Constant\ConfigKey;
use FactorioItemBrowser\Api\Client\Serializer\ContextFactory;
use FactorioItemBrowser\Api\Client\Serializer\Handler\Base64Handler;
use FactorioItemBrowser\Api\Client\Serializer\Listener\ReducedEntityListener;
use Interop\Container\ContainerInterface;
use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use JMS\Serializer\SerializerInterface;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerExceptionInterface;

/**
 * The test case for the serializing and deserializing of objects.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
abstract class SerializerTestCase extends TestCase
{
    private SerializerInterface $serializer;

    /**
     * @throws ContainerExceptionInterface
     */
    protected function setUp(): void
    {
        $config = require(__DIR__ . '/../../config/api-client.php');

        $container = $this->createMock(ContainerInterface::class);
        $container->expects($this->any())
                  ->method('get')
                  ->willReturnMap([
                      ['config', $config],
                      [Base64Handler::class, new Base64Handler()],
                      [ContextFactory::class, new ContextFactory()],
                      [IdenticalPropertyNamingStrategy::class, new IdenticalPropertyNamingStrategy()],
                      [ReducedEntityListener::class, new ReducedEntityListener()],
                  ]);

        $serializerFactory = new JmsSerializerFactory(ConfigKey::MAIN, ConfigKey::SERIALIZER);
        $this->serializer = $serializerFactory($container, SerializerInterface::class);
    }

    /**
     * @param array<mixed> $expectedData
     * @param object $object
     */
    protected function assertSerialization(array $expectedData, object $object): void
    {
        $actualData = json_decode($this->serializer->serialize($object, 'json'), true);
        $this->assertEquals($expectedData, $actualData);
    }

    /**
     * @param object $expectedObject
     * @param array<mixed> $data
     */
    protected function assertDeserialization(object $expectedObject, array $data): void
    {
        $actualObject = $this->serializer->deserialize((string) json_encode($data), get_class($expectedObject), 'json');
        $this->assertEquals($expectedObject, $actualObject);
    }
}

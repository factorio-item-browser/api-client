<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\Api\Client;

use FactorioItemBrowser\Api\Client\Serializer\SerializerFactory;
use Interop\Container\ContainerInterface;
use JMS\Serializer\SerializerInterface;
use PHPUnit\Framework\TestCase;

/**
 * The test case for the serializing and deserializing of objects.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
abstract class SerializerTestCase extends TestCase
{
    private SerializerInterface $serializer;

    protected function setUp(): void
    {
        $container = $this->createMock(ContainerInterface::class);

        $serializerFactory = new SerializerFactory();
        $this->serializer = $serializerFactory($container, SerializerInterface::class);
    }

    public function testSerialize(): void
    {
        $object = $this->getObject();
        $expectedData = $this->getData();

        $result = $this->serializer->serialize($object, 'json');

        $this->assertEquals($expectedData, json_decode($result, true));
    }

    public function testDeserialize(): void
    {
        $data = $this->getData();
        $expectedObject = $this->getObject();

        $result = $this->serializer->deserialize((string) json_encode($data), get_class($expectedObject), 'json');

        $this->assertEquals($expectedObject, $result);
    }

    /**
     * Returns the object to be serialized or deserialized.
     * @return object
     */
    abstract protected function getObject(): object;

    /**
     * Returns the serialized data.
     * @return array<mixed>
     */
    abstract protected function getData(): array;
}

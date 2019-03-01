<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestAsset\Api\Client;

use FactorioItemBrowser\Api\Client\Serializer\SerializerFactory;
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
    /**
     * Creates and returns the serializer.
     * @return SerializerInterface
     */
    protected function createSerializer(): SerializerInterface
    {
        $serializerFactory = new SerializerFactory();
        return $serializerFactory();
    }

    /**
     * Tests the serializing.
     */
    public function testSerialize(): void
    {
        $object = $this->getObject();
        $expectedData = $this->getData();

        $serializer = $this->createSerializer();
        $result = $serializer->serialize($object, 'json');

        $this->assertEquals($expectedData, json_decode($result, true));
    }

    /**
     * Tests the deserializing.
     */
    public function testDeserialize(): void
    {
        $data = $this->getData();
        $expectedObject = $this->getObject();

        $serializer = $this->createSerializer();
        $result = $serializer->deserialize(json_encode($data), get_class($expectedObject), 'json');

        $this->assertEquals($expectedObject, $result);
    }

    /**
     * Returns the object to be serialized or deserialized.
     * @return object
     */
    abstract protected function getObject(): object;

    /**
     * Returns the serialized data.
     * @return array
     */
    abstract protected function getData(): array;
}

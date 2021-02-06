<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\Api\Client;

use FactorioItemBrowser\Api\Client\Serializer\ContextFactory;
use FactorioItemBrowser\Api\Client\Serializer\Handler\Base64Handler;
use JMS\Serializer\Handler\HandlerRegistry;
use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use JMS\Serializer\SerializerBuilder;
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
        $builder = new SerializerBuilder();
        $builder->setMetadataDirs([
                    'FactorioItemBrowser\Api\Client' => __DIR__ . '/../../config/serializer',
                ])
                ->setPropertyNamingStrategy(new IdenticalPropertyNamingStrategy())
                ->setSerializationContextFactory(new ContextFactory())
                ->addDefaultHandlers()
                ->configureHandlers(function (HandlerRegistry $registry): void {
                    $registry->registerSubscribingHandler(new Base64Handler());
                });

        $this->serializer = $builder->build();
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

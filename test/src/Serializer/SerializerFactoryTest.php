<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Serializer;

use FactorioItemBrowser\Api\Client\Serializer\ContextFactory;
use FactorioItemBrowser\Api\Client\Serializer\SerializerFactory;
use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use JMS\Serializer\SerializerBuilder;
use PHPUnit\Framework\TestCase;

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
     * @covers ::__invoke
     */
    public function testInvoke(): void
    {
        $builder = SerializerBuilder::create();
        $builder->addMetadataDir(
                    (string) realpath(__DIR__ . '/../../../config/serializer'),
                    'FactorioItemBrowser\Api\Client'
                )
                ->setPropertyNamingStrategy(new IdenticalPropertyNamingStrategy())
                ->setSerializationContextFactory(new ContextFactory());
        $expectedResult = $builder->build();

        $factory = new SerializerFactory();
        $result = $factory();

        $this->assertEquals($expectedResult, $result);
    }
}

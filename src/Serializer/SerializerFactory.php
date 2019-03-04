<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Serializer;

use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;

/**
 * The factory for the JMS serializer.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class SerializerFactory
{
    /**
     * Creates the serializer.
     * @return SerializerInterface
     */
    public function __invoke(): SerializerInterface
    {
        $builder = SerializerBuilder::create();
        $builder
            ->addMetadataDir(
                (string) realpath(__DIR__ . '/../../config/serializer'),
                'FactorioItemBrowser\Api\Client'
            )
            ->setPropertyNamingStrategy(new IdenticalPropertyNamingStrategy())
            ->setSerializationContextFactory(new ContextFactory());

        return $builder->build();
    }
}

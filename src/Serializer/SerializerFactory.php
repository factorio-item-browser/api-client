<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Serializer;

use Interop\Container\ContainerInterface;
use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * The factory for the JMS serializer.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class SerializerFactory implements FactoryInterface
{
    /**
     * Creates the serializer.
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return SerializerInterface
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): SerializerInterface
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

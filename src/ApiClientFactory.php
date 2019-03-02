<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client;

use FactorioItemBrowser\Api\Client\Client\GuzzleClientFactory;
use FactorioItemBrowser\Api\Client\Client\Options;
use FactorioItemBrowser\Api\Client\Serializer\SerializerFactory;
use FactorioItemBrowser\Api\Client\Service\EndpointService;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Interop\Container\ContainerInterface;
use JMS\Serializer\SerializerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * The factory of the API client.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ApiClientFactory implements FactoryInterface
{
    /**
     * Creates the API client.
     * @param  ContainerInterface $container
     * @param  string $requestedName
     * @param  null|array $options
     * @return ApiClient
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): ApiClient
    {
        return new ApiClient(
            $container->get(EndpointService::class),
            $this->createGuzzleClient($container),
            $container->get(Options::class),
            $this->createSerializer()
        );
    }

    /**
     * Creates the Guzzle client.
     * @param ContainerInterface $container
     * @return ClientInterface
     */
    protected function createGuzzleClient(ContainerInterface $container): ClientInterface
    {
        $factory = new GuzzleClientFactory();
        return $factory($container, Client::class);
    }

    /**
     * Creates the Serializer.
     * @return SerializerInterface
     */
    protected function createSerializer(): SerializerInterface
    {
        $factory = new SerializerFactory();
        return $factory();
    }
}

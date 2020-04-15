<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client;

use FactorioItemBrowser\Api\Client\Client\Options;
use FactorioItemBrowser\Api\Client\Constant\ServiceName;
use FactorioItemBrowser\Api\Client\Service\EndpointService;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

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
     * @param  array<mixed>|null $options
     * @return ApiClient
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): ApiClient
    {
        return new ApiClient(
            $container->get(EndpointService::class),
            $container->get(ServiceName::GUZZLE_CLIENT),
            $container->get(Options::class),
            $container->get(ServiceName::SERIALIZER)
        );
    }
}

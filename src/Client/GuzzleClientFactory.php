<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Client;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * The factory of the Guzzle client.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class GuzzleClientFactory implements FactoryInterface
{
    /**
     * Creates the Guzzle client.
     * @param  ContainerInterface $container
     * @param  string $requestedName
     * @param  null|array $options
     * @return ClientInterface
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): ClientInterface
    {
        /* @var Options $options */
        $options = $container->get(Options::class);

        return new Client([
            'base_uri' => $options->getApiUrl(),
            'timeout' => $options->getTimeout()
        ]);
    }
}

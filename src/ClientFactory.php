<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client;

use FactorioItemBrowser\Api\Client\Constant\ConfigKey;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\RequestOptions;
use JMS\Serializer\SerializerInterface;
use Psr\Container\ContainerInterface;

/**
 * The factory of the API client.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ClientFactory
{
    public function __invoke(ContainerInterface $container): ClientInterface
    {
        $config = $container->get('config')[ConfigKey::MAIN];

        $guzzleClient = new GuzzleClient([
            'base_uri' => $config[ConfigKey::BASE_URI],
            RequestOptions::TIMEOUT => $config[ConfigKey::TIMEOUT],
            RequestOptions::HEADERS => array_filter([
                'Api-Key' => $config[ConfigKey::API_KEY] ?? '',
            ]),
        ]);
        $serializer = $container->get(SerializerInterface::class . ' $apiClientSerializer');
        $endpoints = array_map(fn (string $alias) => $container->get($alias), $config[ConfigKey::ENDPOINTS]);

        return new Client($guzzleClient, $serializer, $endpoints);
    }
}

<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client;

use FactorioItemBrowser\Api\Client\Constant\ConfigKey;
use FactorioItemBrowser\Api\Client\Constant\HeaderName;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\ClientInterface as GuzzleClientInterface;
use GuzzleHttp\RequestOptions;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerExceptionInterface;

/**
 * The factory for the Guzzle client used by this library.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class GuzzleClientFactory implements FactoryInterface
{
    /**
     * @param array<mixed>|null $options
     * @throws ContainerExceptionInterface
     */
    public function __invoke(
        ContainerInterface $container,
        mixed $requestedName,
        ?array $options = null,
    ): GuzzleClientInterface {
        $config = $container->get('config')[ConfigKey::MAIN]; // @phpstan-ignore-line

        return new GuzzleClient([
            'base_uri' => $config[ConfigKey::BASE_URI], // @phpstan-ignore-line
            RequestOptions::TIMEOUT => $config[ConfigKey::TIMEOUT], // @phpstan-ignore-line
            RequestOptions::HEADERS => array_filter([
                HeaderName::API_KEY => $config[ConfigKey::API_KEY] ?? '', // @phpstan-ignore-line
            ]),
        ]);
    }
}

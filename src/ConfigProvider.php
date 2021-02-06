<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client;

/**
 * The config provider of the API client library.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ConfigProvider
{
    /**
     * @return array<mixed>
     */
    public function __invoke(): array
    {
        return array_merge(
            require(__DIR__ . '/../config/api-client.php'),
            require(__DIR__ . '/../config/dependencies.php')
        );
    }
}

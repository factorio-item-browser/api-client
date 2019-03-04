<?php

declare(strict_types=1);

/**
 * The config for the api-client library itself.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */

namespace FactorioItemBrowser\Api\Client;

use FactorioItemBrowser\Api\Client\Constant\ConfigKey;

return [
    ConfigKey::PROJECT => [
        ConfigKey::LIBRARY => [
            ConfigKey::ENDPOINTS => [
                Endpoint\Auth\AuthEndpoint::class,
                Endpoint\Generic\GenericDetailsEndpoint::class,
                Endpoint\Generic\GenericIconEndpoint::class,
                Endpoint\Item\ItemIngredientEndpoint::class,
                Endpoint\Item\ItemProductEndpoint::class,
                Endpoint\Item\ItemRandomEndpoint::class,
                Endpoint\Mod\ModListEndpoint::class,
                Endpoint\Mod\ModMetaEndpoint::class,
                Endpoint\Recipe\RecipeDetailsEndpoint::class,
                Endpoint\Recipe\RecipeMachinesEndpoint::class,
                Endpoint\Search\SearchQueryEndpoint::class,
            ],
            ConfigKey::OPTIONS => [
                ConfigKey::OPTION_API_URL => '',
                ConfigKey::OPTION_AGENT => '',
                ConfigKey::OPTION_ACCESS_KEY => '',
                ConfigKey::OPTION_TIMEOUT => 0,
            ]
        ],
    ],
];

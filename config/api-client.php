<?php

/**
 * The config for the api-client library itself.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client;

use BluePsyduck\JmsSerializerFactory\Constant\ConfigKey as JmsConfigKey;
use FactorioItemBrowser\Api\Client\Constant\ConfigKey;
use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;

return [
    ConfigKey::MAIN => [
        ConfigKey::ENDPOINTS => [
            Endpoint\Generic\GenericDetailsEndpoint::class,
            Endpoint\Generic\GenericIconEndpoint::class,
            Endpoint\Item\ItemIngredientEndpoint::class,
            Endpoint\Item\ItemListEndpoint::class,
            Endpoint\Item\ItemProductEndpoint::class,
            Endpoint\Item\ItemRandomEndpoint::class,
            Endpoint\Meta\StatusEndpoint::class,
            Endpoint\Mod\ModListEndpoint::class,
            Endpoint\Recipe\RecipeDetailsEndpoint::class,
            Endpoint\Recipe\RecipeListEndpoint::class,
            Endpoint\Recipe\RecipeMachinesEndpoint::class,
            Endpoint\Search\SearchQueryEndpoint::class,
        ],
        ConfigKey::SERIALIZER => [
            JmsConfigKey::PROPERTY_NAMING_STRATEGY => IdenticalPropertyNamingStrategy::class,
            JmsConfigKey::SERIALIZATION_CONTEXT_FACTORY => Serializer\ContextFactory::class,
            JmsConfigKey::ADD_DEFAULT_HANDLERS => true,
            JmsConfigKey::HANDLERS => [
                Serializer\Handler\Base64Handler::class,
            ],
            JmsConfigKey::ADD_DEFAULT_LISTENERS => true,
            JmsConfigKey::LISTENERS => [
                Serializer\Listener\ReducedEntityListener::class,
            ],
        ],
    ],
];

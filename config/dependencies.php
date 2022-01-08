<?php

/**
 * The configuration of the API client dependencies.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
// phpcs:ignoreFile

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client;

use BluePsyduck\JmsSerializerFactory\JmsSerializerFactory;
use BluePsyduck\LaminasAutoWireFactory\AutoWireFactory;
use FactorioItemBrowser\Api\Client\Constant\ConfigKey;
use FactorioItemBrowser\Api\Client\Constant\ServiceName;
use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use JMS\Serializer\SerializerInterface;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'dependencies' => [
        'factories'  => [
            ClientInterface::class => AutoWireFactory::class,

            Endpoint\Generic\GenericDetailsEndpoint::class => InvokableFactory::class,
            Endpoint\Generic\GenericIconEndpoint::class => InvokableFactory::class,
            Endpoint\Item\ItemIngredientEndpoint::class => InvokableFactory::class,
            Endpoint\Item\ItemListEndpoint::class => InvokableFactory::class,
            Endpoint\Item\ItemProductEndpoint::class => InvokableFactory::class,
            Endpoint\Item\ItemRandomEndpoint::class => InvokableFactory::class,
            Endpoint\Mod\ModListEndpoint::class => InvokableFactory::class,
            Endpoint\Recipe\RecipeDetailsEndpoint::class => InvokableFactory::class,
            Endpoint\Recipe\RecipeListEndpoint::class => InvokableFactory::class,
            Endpoint\Recipe\RecipeMachinesEndpoint::class => InvokableFactory::class,
            Endpoint\Search\SearchQueryEndpoint::class => InvokableFactory::class,

            Serializer\ContextFactory::class => InvokableFactory::class,
            Serializer\Handler\Base64Handler::class => InvokableFactory::class,
            Serializer\Listener\ReducedEntityListener::class => InvokableFactory::class,

            ServiceName::GUZZLE_CLIENT => GuzzleClientFactory::class,
            ServiceName::SERIALIZER => new JmsSerializerFactory(ConfigKey::MAIN, ConfigKey::SERIALIZER),

            // 3rd party dependencies
            IdenticalPropertyNamingStrategy::class => InvokableFactory::class,
        ],
    ],
];

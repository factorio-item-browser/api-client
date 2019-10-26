<?php

declare(strict_types=1);

/**
 * The configuration of the API client dependencies.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */

namespace FactorioItemBrowser\Api\Client;

use FactorioItemBrowser\Api\Client\Constant\ServiceName;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'dependencies' => [
        'factories'  => [
            ApiClientInterface::class => ApiClientFactory::class,

            Client\Options::class => Client\OptionsFactory::class,

            Endpoint\Auth\AuthEndpoint::class => InvokableFactory::class,
            Endpoint\Export\ExportCreateEndpoint::class => InvokableFactory::class,
            Endpoint\Export\ExportStatusEndpoint::class => InvokableFactory::class,
            Endpoint\Generic\GenericDetailsEndpoint::class => InvokableFactory::class,
            Endpoint\Generic\GenericIconEndpoint::class => InvokableFactory::class,
            Endpoint\Item\ItemIngredientEndpoint::class => InvokableFactory::class,
            Endpoint\Item\ItemProductEndpoint::class => InvokableFactory::class,
            Endpoint\Item\ItemRandomEndpoint::class => InvokableFactory::class,
            Endpoint\Mod\ModListEndpoint::class => InvokableFactory::class,
            Endpoint\Recipe\RecipeDetailsEndpoint::class => InvokableFactory::class,
            Endpoint\Recipe\RecipeMachinesEndpoint::class => InvokableFactory::class,
            Endpoint\Search\SearchQueryEndpoint::class => InvokableFactory::class,

            Service\EndpointService::class => Service\EndpointServiceFactory::class,

            // 3rd party dependencies
            ServiceName::GUZZLE_CLIENT => Client\GuzzleClientFactory::class,
            ServiceName::SERIALIZER => Serializer\SerializerFactory::class,
        ],
    ],
];

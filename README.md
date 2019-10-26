# Factorio Item Browser - API Client

[![Latest Stable Version](https://poser.pugx.org/factorio-item-browser/api-client/v/stable)](https://packagist.org/packages/factorio-item-browser/api-client) 
[![License](https://poser.pugx.org/factorio-item-browser/api-client/license)](https://packagist.org/packages/factorio-item-browser/api-client) 
[![Build Status](https://travis-ci.org/factorio-item-browser/api-client.svg?branch=master)](https://travis-ci.org/factorio-item-browser/api-client) 
[![codecov](https://codecov.io/gh/factorio-item-browser/api-client/branch/master/graph/badge.svg)](https://codecov.io/gh/factorio-item-browser/api-client)

This library implements a PHP client to the API of the Factorio Item Browser to access the data of the browser.

The documentation of the API can be found at https://www.factorio-item-browser.com/api/docs

## Features

### Transparent authorization

The client will transparently authorize itself against the API server, you only have to provide your agent data as well
as the mods you want to have enabled. 

It is recommended to save the authorization token of the client after the last request has been executed, and set it
on the next script call of the user. This will skip the authorization request as long as the token remains valid. As 
soon as the token invalidates, the client will request a new token from the server without any further action in your
scripts.

**NOTE:** If you change the mods to be enabled, make sure to clear the authorization token on the client. This is because 
the token holds meta data about the mods from the API server, which will not be re-evaluated as long as a token is 
present.

### Parallel request execution

The client is able to execute multiple requests at once without waiting for their responses. 

To achieve parallel execution, simply call `$apiClient->sendRequest($request)` on your requests one after another 
without calling `$apiClient->fetchResponse($request)` to actually fetch a response. Only the latter method will block
and wait for the request to actually finish. 

When only executing a single request, calling `$apiClient->sendRequest($request)` is optional. It will be invoked 
automatically if it has not been done yet for the request.

## Usage

The client is set up to be used within a Zend Expressive project. Using it in another context requires an additional
setup which is not covered in this README.

To use the client, add the `FactorioItemBrowser\Api\Client\ConfigProvider` to the config aggregator of your project.

### Configuration

The client requires the following configuration to be present in your project:

```php
<?php

use FactorioItemBrowser\Api\Client\Constant\ConfigKey;

return [
    ConfigKey::PROJECT => [
        ConfigKey::API_CLIENT => [
            // The writable directory the client should use to cache some meta data.
            ConfigKey::CACHE_DIR => 'data/cache/api-client',
            // The options to access the API server.
            ConfigKey::OPTIONS => [
                // The URL to the API server, including a trailing slash.
                ConfigKey::OPTION_API_URL => 'https://www.factorio-item-browser.com/api/',
                // The access key of the agent.
                ConfigKey::OPTION_ACCESS_KEY => 'demo',
                // The timeout in seconds to use for the requests.
                ConfigKey::OPTION_TIMEOUT => 10,
            ],
        ],
    ],
];
```

### Example

The usage of the actual client is best described with an example.

```php
<?php 

use FactorioItemBrowser\Api\Client\ApiClientInterface;
use FactorioItemBrowser\Api\Client\Request\Item\ItemRandomRequest;
use FactorioItemBrowser\Api\Client\Request\Mod\ModListRequest;
use FactorioItemBrowser\Api\Client\Response\Item\ItemRandomResponse;
use FactorioItemBrowser\Api\Client\Response\Mod\ModListResponse;
/* @var \Psr\Container\ContainerInterface $container */

// Fetch the API client from the container. This will use the config to initialize it.
/* @var ApiClientInterface $apiClient */
$apiClient = $container->get(ApiClientInterface::class);

// Set the names of the mods to be enabled. Whenever the authorization token times out,
// these mods will be used to re-create it.
$apiClient->setModNames(['base']);

// The API will translate names and descriptions, as long as the mods are providing them.
// The locale codes are the same as in the game.
$apiClient->setLocale('de');

// If you already have an authorization token, set it to the client.
// The client will automatically request a new token if none is present or the old one timed out.
$apiClient->setAuthorizationToken('<Your token>');



// Create an instance of the request class you want to call, and set its parameters.
$randomItemRequest = new ItemRandomRequest();
$randomItemRequest->setNumberOfResults(10)
                  ->setNumberOfRecipesPerResult(3);

// Send the request to the API server.
// This will send the request to the server, but will not wait for it to finish. So you can
// send another request to the servers to run in parallel.
$apiClient->sendRequest($randomItemRequest); // Non-blocking

// Lets send a second request.
$modListRequest = new ModListRequest();
$apiClient->sendRequest($modListRequest); // Non-blocking

// To actually process the response, you have to fetch it from the client. This method will actually
// wait for the request to be finished.

/* @var  ItemRandomResponse $randomItemsResponse */
$randomItemsResponse = $apiClient->fetchResponse($randomItemRequest); // Blocking 
/* @var ModListResponse $modListResponse */
$modListResponse = $apiClient->fetchResponse($modListRequest); // Blocking

// Do something with the received data.
var_dump($randomItemsResponse->getItems());
var_dump($modListResponse->getMods());


// Save the authorization token after the last request in the session or somewhere and re-use it on the next script
// call. This will save you the initial auth request of the client.
// Remember that the authorization token may have changed if the old one timed out.
$authorizationToken = $apiClient->getAuthorizationToken();
```

For testing purposes, you can use the "demo" agent as used in the example. Note that this agent is restricted to the 
base mod and you will not be able to enable any other mods.

![Factorio Item Browser](https://raw.githubusercontent.com/factorio-item-browser/documentation/master/asset/image/logo.png) 

# API Client Library

[![GitHub release (latest SemVer)](https://img.shields.io/github/v/release/factorio-item-browser/api-client)](https://github.com/factorio-item-browser/api-client/releases)
[![GitHub](https://img.shields.io/github/license/factorio-item-browser/api-client)](LICENSE.md)
[![build](https://img.shields.io/github/workflow/status/factorio-item-browser/api-client/CI?logo=github)](https://github.com/factorio-item-browser/api-client/actions)
[![Codecov](https://img.shields.io/codecov/c/gh/factorio-item-browser/api-client?logo=codecov)](https://codecov.io/gh/factorio-item-browser/api-client)

This library implements a PHP client to the data API of the Factorio Item Browser to access its data.

The documentation of the API can be found at https://docs.factorio-item-browser.com/api

## Usage

The client is set up to be used within a Laminas project. Using it in another context requires an additional
setup which is not covered in this README.

To use the client, add the `FactorioItemBrowser\Api\Client\ConfigProvider` to the config aggregator of your project.

### Configuration

The client requires the following configuration to be present in your project:

```php
<?php

use FactorioItemBrowser\Api\Client\Constant\ConfigKey;

return [
    ConfigKey::MAIN => [
        // The URL to the API server, including a trailing slash.
        ConfigKey::BASE_URI => 'https://api.factorio-item-browser.com/',
        // The Api-Key to access the API.
        ConfigKey::API_KEY => 'foo',
        // The timeout in seconds to use for the requests.
        ConfigKey::TIMEOUT => 10,
    ],
];
```

### Example

The usage of the actual client is best described with an example.

```php
<?php 

use FactorioItemBrowser\Api\Client\ClientInterface;
use FactorioItemBrowser\Api\Client\Request\Item\ItemRandomRequest;
use FactorioItemBrowser\Api\Client\Request\Mod\ModListRequest;
use FactorioItemBrowser\Api\Client\Response\Item\ItemRandomResponse;
use FactorioItemBrowser\Api\Client\Response\Mod\ModListResponse;
/* @var \Psr\Container\ContainerInterface $container */

// Fetch the API client from the container. This will use the config to initialize it.
/* @var ClientInterface $client */
$client = $container->get(ClientInterface::class);

// Create an instance of the request class you want to call, and set its parameters.
$randomItemRequest = new ItemRandomRequest();
$randomItemRequest->combinationId = '2f4a45fa-a509-a9d1-aae6-ffcf984a7a76';
$randomItemRequest->locale = 'de';
$randomItemRequest->numberOfResults = 10;
$randomItemRequest->numberOfRecipesPerResult = 3;

// Send the request to the API server.
// This call is non-blocking, returning a Promise. For further details about promises, read the documentation of
// the Guzzle HTTP client.
$randomItemPromise = $client->sendRequest($randomItemRequest); // Non-blocking

// Lets send a second request.
$modListRequest = new ModListRequest();
$modListRequest->combinationId = '2f4a45fa-a509-a9d1-aae6-ffcf984a7a76';
$modListRequest->locale = 'de';
$modListPromise = $client->sendRequest($modListRequest); // Non-blocking

// To actually process the response, you have to wait on the promises to be fulfilled.
/* @var  ItemRandomResponse $randomItemsResponse */
$randomItemsResponse = $randomItemPromise->wait(); // Blocking 
/* @var ModListResponse $modListResponse */
$modListResponse = $modListPromise->wait(); // Blocking

// Do something with the received data.
var_dump($randomItemsResponse->items);
var_dump($modListResponse->mods);
```

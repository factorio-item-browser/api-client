# Factorio Item Browser - API Client

[![Latest Stable Version](https://poser.pugx.org/factorio-item-browser/api-client/v/stable)](https://packagist.org/packages/factorio-item-browser/api-client) [![License](https://poser.pugx.org/factorio-item-browser/api-client/license)](https://packagist.org/packages/factorio-item-browser/api-client) [![Build Status](https://travis-ci.org/factorio-item-browser/api-client.svg?branch=master)](https://travis-ci.org/factorio-item-browser/api-client) [![codecov](https://codecov.io/gh/factorio-item-browser/api-client/branch/master/graph/badge.svg)](https://codecov.io/gh/factorio-item-browser/api-client)

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

To achieve parallel execution, simply `$client->send($request)` your requests one after another without calling 
anything on the returned response object. The first call of a getter on the response will block and wait for the 
request to finish.

## Usage

The usage of the library is pretty straight-forward and best explained with an example.

```php
<?php 

// Initialize the client with the basic information required to access the API server.
$options = new FactorioItemBrowser\Api\Client\Client\Options();
$options->setApiUrl('https://www.factorio-item-browser.com/api')
        ->setAgent('demo')
        ->setAccessKey('factorio-item-browser');

$client = new FactorioItemBrowser\Api\Client\Client\Client($options);

// Set the names of the mods to be enabled. Whenever the authorization token times out,
// These mods will be used to re-create it.
$client->setEnabledModNames(['base']);

// The API will translate names and descriptions, as long as the mods are providing them.
// The locale codes are the same as in the game.
$client->setLocale('de');

// If you already have an authorization token, set it to the client.
// The client will automatically request a new token if none is present or the old one timed out.
$client->setAuthorizationToken('<Your token>');



// Create an instance of the request class you want to call, and set its parameters.
$randomItemRequest = new FactorioItemBrowser\Api\Client\Request\Item\ItemRandomRequest();
$randomItemRequest->setNumberOfResults(10)
                  ->setNumberOfRecipesPerResult(3);

// Send the request to the API server.
// This will send the request to the server, but will not wait for it to finish. So you can
// send another request to the servers to run in parallel.
/* @var FactorioItemBrowser\Api\Client\Response\Item\ItemRandomResponse $randomItemResponse */
$randomItemResponse = $client->send($randomItemRequest); // Non-blocking

// Lets send a second request.
$modListRequest = new FactorioItemBrowser\Api\Client\Request\Mod\ModListRequest();
/* @var FactorioItemBrowser\Api\Client\Response\Mod\ModListResponse $modListResponse */
$modListResponse = $client->send($modListRequest); // Non-blocking

// As soon as you call any getter on the response, this method will be blocking and wait for the request to finish.
// The order does not matter. The getter will always wait for its request to finish, not on any other ones.
$mods = $modListResponse->getMods(); // Blocking. Will wait for the $modListRequest to finish.
$randomItems = $randomItemResponse->getItems(); // Blocking. Will wait for the $randomItemRequest to finish.

// Do something with the received data.
var_dump($randomItems);
var_dump($mods);



// Save the authorization token after the last request in the session or somewhere and re-use it on the next script
// call. This will save you the initial auth request of the client.
// Remember that the authorization token may have changed if the old one timed out.
$authorizationToken = $client->getAuthorizationToken();
```

For testing purposes, you can use the "demo" agent as used in the example. Note that this agent is restricted to the 
base mod and you will not be able to enable any other mods.

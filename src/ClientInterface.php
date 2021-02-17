<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client;

use FactorioItemBrowser\Api\Client\Exception\ClientException;
use FactorioItemBrowser\Api\Client\Request\AbstractRequest;
use GuzzleHttp\Promise\PromiseInterface;

/**
 * The interface of the client.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
interface ClientInterface
{
    /**
     * Sends the request to the server, returning a promise fulfilled as soon as the request finishes.
     * @param AbstractRequest $request
     * @return PromiseInterface
     * @throws ClientException
     */
    public function sendRequest(AbstractRequest $request): PromiseInterface;

    /**
     * Sets the default values to use when the request does not provide those itself.
     * @param string $combinationId
     * @param string $locale
     */
    public function setDefaults(string $combinationId, string $locale): void;
}

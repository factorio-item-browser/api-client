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
     * Sends the request to the server
     * @param AbstractRequest $request
     * @return PromiseInterface
     * @throws ClientException
     */
    public function sendRequest(AbstractRequest $request): PromiseInterface;
}

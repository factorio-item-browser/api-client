<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Endpoint;

use FactorioItemBrowser\Api\Client\Request\AbstractRequest;

/**
 * The interface of the endpoint classes.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 *
 * @template TRequest of AbstractRequest
 * @template TResponse of object
 */
interface EndpointInterface
{
    /**
     * Returns the request class handled by the endpoint.
     * @return class-string<TRequest>
     */
    public function getHandledRequestClass(): string;

    /**
     * Returns the request path of the endpoint.
     * @param TRequest $request
     * @return string
     */
    public function getRequestPath(AbstractRequest $request): string;

    /**
     * Creates the response of the endpoint.
     * @return class-string<TResponse>
     */
    public function getResponseClass(): string;
}

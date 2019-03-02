<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Endpoint\Search;

use FactorioItemBrowser\Api\Client\Endpoint\EndpointInterface;
use FactorioItemBrowser\Api\Client\Request\Search\SearchQueryRequest;
use FactorioItemBrowser\Api\Client\Response\Search\SearchQueryResponse;

/**
 * The endpoint of the search query request.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class SearchQueryEndpoint implements EndpointInterface
{
    /**
     * Returns the request class supported by the endpoint.
     * @return string
     */
    public function getSupportedRequestClass(): string
    {
        return SearchQueryRequest::class;
    }

    /**
     * Returns whether or not this endpoint requires an authorization token.
     * @return bool
     */
    public function requiresAuthorizationToken(): bool
    {
        return true;
    }

    /**
     * Returns the request path of the endpoint.
     * @return string
     */
    public function getRequestPath(): string
    {
        return 'search/query';
    }

    /**
     * Creates the response of the endpoint.
     * @return string
     */
    public function getResponseClass(): string
    {
        return SearchQueryResponse::class;
    }
}

<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Endpoint\Search;

use FactorioItemBrowser\Api\Client\Endpoint\EndpointInterface;
use FactorioItemBrowser\Api\Client\Request\AbstractRequest;
use FactorioItemBrowser\Api\Client\Request\Search\SearchQueryRequest;
use FactorioItemBrowser\Api\Client\Response\Search\SearchQueryResponse;

/**
 * The endpoint of the search query request.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 *
 * @implements EndpointInterface<SearchQueryRequest, SearchQueryResponse>
 */
class SearchQueryEndpoint implements EndpointInterface
{
    public function getHandledRequestClass(): string
    {
        return SearchQueryRequest::class;
    }

    public function getRequestPath(AbstractRequest $request): string
    {
        return "{$request->combinationId}/search/query";
    }

    public function getResponseClass(): string
    {
        return SearchQueryResponse::class;
    }
}

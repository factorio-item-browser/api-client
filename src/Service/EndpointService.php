<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Service;

use FactorioItemBrowser\Api\Client\Endpoint\EndpointInterface;
use FactorioItemBrowser\Api\Client\Request\RequestInterface;

/**
 * The service holding the available endpoints.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class EndpointService
{
    /**
     * The available endpoints.
     * @var array|EndpointInterface[]
     */
    protected $endpointsByRequestClass;

    /**
     * Initializes the service.
     * @param array|EndpointInterface[] $endpoints
     */
    public function __construct(array $endpoints)
    {
        foreach ($endpoints as $endpoint) {
            $this->endpointsByRequestClass[$endpoint->getSupportedRequestClass()] = $endpoint;
        }
    }

    /**
     * Returns the endpoint for the request.
     * @param RequestInterface $request
     * @return EndpointInterface
     */
    public function getEndpointForRequest(RequestInterface $request): EndpointInterface
    {
        return $this->endpointsByRequestClass[get_class($request)];
    }
}

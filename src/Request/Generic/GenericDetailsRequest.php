<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Request\Generic;

use FactorioItemBrowser\Api\Client\Request\RequestInterface;
use FactorioItemBrowser\Api\Client\Response\AbstractResponse;
use FactorioItemBrowser\Api\Client\Response\Generic\GenericDetailsResponse;
use FactorioItemBrowser\Api\Client\Response\PendingResponse;

/**
 * The request of generic details of entities.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class GenericDetailsRequest implements RequestInterface
{
    /**
     * The entities to request the details for.
     * @var array
     */
    protected $entities = [];

    /**
     * Adds an entity to request the details for.
     * @param string $type
     * @param string $name
     * @return $this
     */
    public function addEntity(string $type, string $name)
    {
        $this->entities[] = [
            'type' => $type,
            'name' => $name
        ];
        return $this;
    }

    /**
     * Returns the path of the request, relative to the API URL.
     * @return string
     */
    public function getRequestPath(): string
    {
        return '/generic/details';
    }

    /**
     * Returns the actual data of the request.
     * @return array
     */
    public function getRequestData(): array
    {
        return [
            'entities' => $this->entities
        ];
    }

    /**
     * Creates the response instance matching the request.
     * @param PendingResponse $pendingResponse
     * @return AbstractResponse
     */
    public function createResponse(PendingResponse $pendingResponse): AbstractResponse
    {
        return new GenericDetailsResponse($pendingResponse);
    }
}
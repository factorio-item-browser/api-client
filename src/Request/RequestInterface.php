<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Request;

use FactorioItemBrowser\Api\Client\Response\AbstractResponse;
use FactorioItemBrowser\Api\Client\Response\PendingResponse;

/**
 * The interface of the requests to the API server.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
interface RequestInterface
{
    /**
     * Returns the path of the request, relative to the API URL.
     * @return string
     */
    public function getRequestPath(): string;

    /**
     * Returns the actual data of the request.
     * @return array
     */
    public function getRequestData(): array;

    /**
     * Creates the response instance matching the request.
     * @param PendingResponse $pendingResponse
     * @return AbstractResponse
     */
    public function createResponse(PendingResponse $pendingResponse): AbstractResponse;
}
<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestAsset\Api\Client\Response;

use BluePsyduck\MultiCurl\Entity\Request;
use FactorioItemBrowser\Api\Client\Client\Client;
use FactorioItemBrowser\Api\Client\Client\Options;
use FactorioItemBrowser\Api\Client\Response\PendingResponse;

/**
 * An extension of the pending response to be used in tests.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class TestPendingResponse extends PendingResponse
{
    /**
     * The data to return with the fetchResponse call.
     * @var array
     */
    protected $responseData;

    /**
     * Initializes the pending response.
     * @param array $responseData
     */
    public function __construct(array $responseData = [])
    {
        parent::__construct(new Client(new Options()), new Request());
        $this->responseData = $responseData;
    }


    /**
     * Fetches the response by waiting until the request is actually finished.
     * @return array
     */
    public function fetchResponse(): array
    {
        return $this->responseData;
    }
}
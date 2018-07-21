<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestAsset\Api\Client\Request;

use FactorioItemBrowser\Api\Client\Request\RequestInterface;
use FactorioItemBrowser\Api\Client\Response\AbstractResponse;
use FactorioItemBrowser\Api\Client\Response\PendingResponse;
use FactorioItemBrowserTestAsset\Api\Client\Response\TestResponse;

/**
 * A test implementation of the request interface.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class TestRequest implements RequestInterface
{
    /**
     * The request path.
     * @var string
     */
    protected $requestPath;

    /**
     * The request data.
     * @var array
     */
    protected $requestData;

    /**
     * Initializes the request.
     * @param string $requestPath
     * @param array $requestData
     */
    public function __construct(string $requestPath, array $requestData)
    {
        $this->requestPath = $requestPath;
        $this->requestData = $requestData;
    }


    /**
     * Returns the path of the request, relative to the API URL.
     * @return string
     */
    public function getRequestPath(): string
    {
        return $this->requestPath;
    }

    /**
     * Returns the actual data of the request.
     * @return array
     */
    public function getRequestData(): array
    {
        return $this->requestData;
    }

    /**
     * Creates the response instance matching the request.
     * @param PendingResponse $pendingResponse
     * @return AbstractResponse
     */
    public function createResponse(PendingResponse $pendingResponse): AbstractResponse
    {
        return new TestResponse($pendingResponse);
    }
}

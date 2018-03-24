<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Response;

use BluePsyduck\Common\Data\DataContainer;
use FactorioItemBrowser\Api\Client\Entity\Meta;
use FactorioItemBrowser\Api\Client\Exception\ApiClientException;

/**
 * The abstract class of the responses from the API server.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
abstract class AbstractResponse
{
    /**
     * The pending response instance.
     * @var PendingResponse|null
     */
    protected $pendingResponse = null;

    /**
     * The meta information of the response.
     * @var Meta
     */
    protected $meta;

    /**
     * Initializes the response.
     * @param PendingResponse $pendingResponse
     */
    public function __construct(PendingResponse $pendingResponse)
    {
        $this->pendingResponse = $pendingResponse;
    }

    /**
     * Returns the meta information of the response.
     * @return Meta
     * @throws ApiClientException
     */
    public function getMeta(): Meta
    {
        $this->checkPendingResponse();
        return $this->meta;
    }

    /**
     * Checks for the response if it has not been mapped yet.
     * @return $this
     * @throws ApiClientException
     */
    protected function checkPendingResponse()
    {
        if (!is_null($this->pendingResponse)) {
            $responseData = $this->pendingResponse->fetchResponse();
            $this->mapResponse(new DataContainer($responseData));
            $this->pendingResponse = null;
        }
        return $this;
    }

    /**
     * Maps the response data.
     * @param DataContainer $responseData
     * @return $this
     */
    protected function mapResponse(DataContainer $responseData)
    {
        $this->meta = (new Meta())->readData($responseData->getObject('meta'));
        return $this;
    }
}
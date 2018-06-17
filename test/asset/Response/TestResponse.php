<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestAsset\Api\Client\Response;

use BluePsyduck\Common\Data\DataContainer;
use FactorioItemBrowser\Api\Client\Response\AbstractResponse;
use FactorioItemBrowser\Api\Client\Response\PendingResponse;

/**
 * A test implementation of the response.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class TestResponse extends AbstractResponse
{
    /**
     * Maps the response data.
     * @param DataContainer $responseData
     * @return $this
     */
    protected function mapResponse(DataContainer $responseData)
    {
        return $this;
    }

    /**
     * The pending response instance.
     * @return PendingResponse|null
     */
    public function getPendingResponse(): PendingResponse
    {
        return $this->pendingResponse;
    }
}

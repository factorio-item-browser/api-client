<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Response\Auth;

use BluePsyduck\Common\Data\DataContainer;
use FactorioItemBrowser\Api\Client\Response\AbstractResponse;

/**
 * The response of the auth request.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class AuthResponse extends AbstractResponse
{
    /**
     * The authorization token to use in the other requests.
     * @var string
     */
    protected $authorizationToken;

    /**
     * Returns the authorization token to use in the other requests.
     * @return string
     */
    public function getAuthorizationToken(): string
    {
        $this->checkResponse();
        return $this->authorizationToken;
    }

    /**
     * Maps the response data.
     * @param DataContainer $responseData
     * @return $this
     */
    protected function mapResponse(DataContainer $responseData)
    {
        parent::mapResponse($responseData);
        $this->authorizationToken = $responseData->getString('authorizationToken');
        return $this;
    }
}
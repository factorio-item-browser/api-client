<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Response\Auth;

use FactorioItemBrowser\Api\Client\Response\ResponseInterface;

/**
 * The response of the auth request.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class AuthResponse implements ResponseInterface
{
    /**
     * The authorization token to use in the other requests.
     * @var string
     */
    protected $authorizationToken = '';

    /**
     * Sets the the authorization token to use in the other requests.
     * @param string $authorizationToken
     * @return $this
     */
    public function setAuthorizationToken(string $authorizationToken): self
    {
        $this->authorizationToken = $authorizationToken;
        return $this;
    }

    /**
     * Returns the authorization token to use in the other requests.
     * @return string
     */
    public function getAuthorizationToken(): string
    {
        return $this->authorizationToken;
    }
}

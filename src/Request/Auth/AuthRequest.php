<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Request\Auth;

use FactorioItemBrowser\Api\Client\Request\RequestInterface;

/**
 * The request of the authorization token.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class AuthRequest implements RequestInterface
{
    /**
     * The access key to the API.
     * @var string
     */
    protected $accessKey = '';

    /**
     * The names of the mods to enable.
     * @var array|string[]
     */
    protected $modNames = [];

    /**
     * Sets the access key to the API.
     * @param string $accessKey
     * @return $this
     */
    public function setAccessKey(string $accessKey): self
    {
        $this->accessKey = $accessKey;
        return $this;
    }

    /**
     * Returns the the access key to the API.
     * @return string
     */
    public function getAccessKey(): string
    {
        return $this->accessKey;
    }

    /**
     * Sets the names of the mods to enable.
     * @param array|string[] $modNames
     * @return $this
     */
    public function setModNames(array $modNames): self
    {
        $this->modNames = $modNames;
        return $this;
    }

    /**
     * Returns the names of the mods to enable.
     * @return array|string[]
     */
    public function getModNames()
    {
        return $this->modNames;
    }
}

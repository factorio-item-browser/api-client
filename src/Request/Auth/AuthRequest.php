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
     * The agent to use for the API.
     * @var string
     */
    protected $agent = '';

    /**
     * The access key to the API.
     * @var string
     */
    protected $accessKey = '';

    /**
     * The internal names of the mods to enable.
     * @var array|string[]
     */
    protected $enabledModNames = [];

    /**
     * Sets the agent to use for the API.
     * @param string $agent
     * @return $this
     */
    public function setAgent(string $agent): self
    {
        $this->agent = $agent;
        return $this;
    }

    /**
     * Returns the the agent to use for the API.
     * @return string
     */
    public function getAgent(): string
    {
        return $this->agent;
    }

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
     * Sets the internal names of the mods to enable.
     * @param array|string[] $enabledModNames
     * @return $this
     */
    public function setEnabledModNames(array $enabledModNames): self
    {
        $this->enabledModNames = $enabledModNames;
        return $this;
    }

    /**
     * Returns the the internal names of the mods to enable.
     * @return array|string[]
     */
    public function getEnabledModNames()
    {
        return $this->enabledModNames;
    }
}

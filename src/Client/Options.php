<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Client;

/**
 * The options of the client.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Options
{
    /**
     * The URL to the API.
     * @var string
     */
    protected $apiUrl = '';

    /**
     * The agent to use for authorization.
     * @var string
     */
    protected $agent = '';

    /**
     * The access key required for authorization.
     * @var string
     */
    protected $accessKey = '';

    /**
     * The timeout to use on requests, in seconds. 0 to not set a timeout.
     * @var int
     */
    protected $timeout = 0;

    /**
     * Sets the URL to the API.
     * @param string $apiUrl
     * @return $this Implementing fluent interface.
     */
    public function setApiUrl(string $apiUrl)
    {
        $this->apiUrl = $apiUrl;
        return $this;
    }

    /**
     * Returns the URL to the API.
     * @return string
     */
    public function getApiUrl(): string
    {
        return $this->apiUrl;
    }

    /**
     * Sets the agent to use for authorization.
     * @param string $agent
     * @return $this Implementing fluent interface.
     */
    public function setAgent(string $agent)
    {
        $this->agent = $agent;
        return $this;
    }

    /**
     * Returns the agent to use for authorization.
     * @return string
     */
    public function getAgent(): string
    {
        return $this->agent;
    }

    /**
     * Sets the access key required for authorization.
     * @param string $accessKey
     * @return $this Implementing fluent interface.
     */
    public function setAccessKey(string $accessKey)
    {
        $this->accessKey = $accessKey;
        return $this;
    }

    /**
     * Returns the access key required for authorization.
     * @return string
     */
    public function getAccessKey(): string
    {
        return $this->accessKey;
    }

    /**
     * Sets the timeout to use on requests, in seconds. 0 to not set a timeout.
     * @param int $timeout
     * @return $this Implementing fluent interface.
     */
    public function setTimeout(int $timeout)
    {
        $this->timeout = $timeout;
        return $this;
    }

    /**
     * Returns the timeout to use on requests, in seconds. 0 to not set a timeout.
     * @return int
     */
    public function getTimeout(): int
    {
        return $this->timeout;
    }
}

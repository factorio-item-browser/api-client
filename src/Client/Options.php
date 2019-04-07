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
     * The locale to use.
     * @var string
     */
    protected $locale = 'en';

    /**
     * The mod names to enable.
     * @var array|string[]
     */
    protected $enabledModNames = [];

    /**
     * The already fetched authorization token.
     * @var string
     */
    protected $authorizationToken = '';

    /**
     * Sets the URL to the API.
     * @param string $apiUrl
     * @return $this
     */
    public function setApiUrl(string $apiUrl): self
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
     * @return $this
     */
    public function setAgent(string $agent): self
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
     * @return $this
     */
    public function setAccessKey(string $accessKey): self
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
     * @return $this
     */
    public function setTimeout(int $timeout): self
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

    /**
     * Sets the locale to use.
     * @param string $locale
     * @return $this
     */
    public function setLocale(string $locale): self
    {
        $this->locale = $locale;
        return $this;
    }

    /**
     * Returns the locale to use.
     * @return string
     */
    public function getLocale(): string
    {
        return $this->locale;
    }

    /**
     * Sets the mod names to enable.
     * @param array|string[] $enabledModNames
     * @return $this
     */
    public function setEnabledModNames(array $enabledModNames)
    {
        $this->enabledModNames = $enabledModNames;
        return $this;
    }

    /**
     * Returns the mod names to enable.
     * @return array|string[]
     */
    public function getEnabledModNames(): array
    {
        return $this->enabledModNames;
    }

    /**
     * Sets the already fetched authorization token.
     * @param string $authorizationToken
     * @return $this
     */
    public function setAuthorizationToken(string $authorizationToken): self
    {
        $this->authorizationToken = $authorizationToken;
        return $this;
    }

    /**
     * Returns the already fetched authorization token.
     * @return string
     */
    public function getAuthorizationToken(): string
    {
        return $this->authorizationToken;
    }
}

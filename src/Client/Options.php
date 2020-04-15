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
    protected $modNames = [];

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
     * @param array|string[] $modNames
     * @return $this
     */
    public function setModNames(array $modNames)
    {
        $this->modNames = $modNames;
        return $this;
    }

    /**
     * Returns the mod names to enable.
     * @return array|string[]
     */
    public function getModNames(): array
    {
        return $this->modNames;
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

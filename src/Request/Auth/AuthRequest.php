<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Request\Auth;

use FactorioItemBrowser\Api\Client\Request\RequestInterface;
use FactorioItemBrowser\Api\Client\Response\AbstractResponse;
use FactorioItemBrowser\Api\Client\Response\Auth\AuthResponse;
use FactorioItemBrowser\Api\Client\Response\PendingResponse;

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
    public function setAgent(string $agent)
    {
        $this->agent = $agent;
        return $this;
    }

    /**
     * Sets the access key to the API.
     * @param string $accessKey
     * @return $this
     */
    public function setAccessKey(string $accessKey)
    {
        $this->accessKey = $accessKey;
        return $this;
    }

    /**
     * Sets the internal names of the mods to enable.
     * @param array|string[] $enabledModNames
     */
    public function setEnabledModNames(array $enabledModNames)
    {
        $this->enabledModNames = $enabledModNames;
    }

    /**
     * Returns the path of the request, relative to the API URL.
     * @return string
     */
    public function getRequestPath(): string
    {
        return '/auth';
    }

    /**
     * Returns the actual data of the request.
     * @return array
     */
    public function getRequestData(): array
    {
        return [
            'agent' => $this->agent,
            'accessKey' => $this->accessKey,
            'enabledModNames' => array_values(array_filter(array_map('strval', $this->enabledModNames)))
        ];
    }

    /**
     * Creates the response instance matching the request.
     * @param PendingResponse $pendingResponse
     * @return AbstractResponse
     */
    public function createResponse(PendingResponse $pendingResponse): AbstractResponse
    {
        return new AuthResponse($pendingResponse);
    }
}
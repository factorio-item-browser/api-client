<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Constant;

/**
 * The interface holding the keys of the config.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
interface ConfigKey
{
    /**
     * The key holding the name of the project.
     */
    public const PROJECT = 'factorio-item-browser';

    /**
     * The key holding the name of the API client itself.
     */
    public const API_CLIENT = 'api-client';

    /**
     * The key holding the cache directory to use.
     */
    public const CACHE_DIR = 'cache-dir';

    /**
     * The key for the endpoints.
     */
    public const ENDPOINTS = 'endpoints';

    /**
     * The key for the client options.
     */
    public const OPTIONS = 'options';

    /**
     * The key for the API URL option.
     */
    public const OPTION_API_URL = 'api-url';

    /**
     * The key for the agent option.
     */
    public const OPTION_AGENT = 'agent';

    /**
     * The key for the access key option.
     */
    public const OPTION_ACCESS_KEY = 'access-key';

    /**
     * The key for the timeout option.
     */
    public const OPTION_TIMEOUT = 'timeout';
}

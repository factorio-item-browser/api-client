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
    public const MAIN = 'api-client';
    public const API_KEY = 'api-key';
    public const BASE_URI = 'base-uri';
    public const ENDPOINTS = 'endpoints';
    public const SERIALIZER = 'serializer';
    public const TIMEOUT = 'timeout';
}

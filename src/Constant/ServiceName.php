<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Constant;

/**
 * The interface holding the additional service names used in the container.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
interface ServiceName
{
    public const GUZZLE_CLIENT = 'combination-api-client.guzzle-client';
    public const SERIALIZER = 'combination-api-client.serializer';
}

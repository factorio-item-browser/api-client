<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Constant;

/**
 * The interface holding the names of services not registered with their class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
interface ServiceName
{
    /**
     * The service name of the Guzzle client.
     */
    public const GUZZLE_CLIENT = 'factorio-item-browser.api.client.guzzle-client';

    /**
     * The service name of the JMS serializer.
     */
    public const SERIALIZER = 'factorio-item-browser.api.client.serializer';
}

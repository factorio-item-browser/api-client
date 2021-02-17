<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Exception;

use Throwable;

/**
 * The exception thrown when the connection to the server could not be established or timed out.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ConnectionException extends ClientException
{
    private const MESSAGE = 'Failed to connect to the server: %s';

    public function __construct(string $message, string $request, ?Throwable $previous = null)
    {
        parent::__construct(sprintf(self::MESSAGE, $message), 0, $request, '', $previous);
    }
}

<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Exception;

use Exception;

/**
 * The exception thrown when the connection to the server could not be established or timed out.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ConnectionException extends ApiClientException
{
    /**
     * Initializes the exception.
     * @param string $message
     * @param string $request
     * @param Exception $previous
     */
    public function __construct(string $message, string $request, Exception $previous = null)
    {
        parent::__construct($message, 0, $request, '', $previous);
    }
}

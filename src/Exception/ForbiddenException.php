<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Exception;

use Exception;

/**
 * The exception thrown when a 403 Forbidden is encountered.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ForbiddenException extends ApiClientException
{
    /**
     * Initializes the exception.
     * @param string $message
     * @param string $request
     * @param string $response
     * @param Exception $previous
     */
    public function __construct(string $message, string $request, string $response = '', Exception $previous = null)
    {
        parent::__construct($message, 403, $request, $response, $previous);
    }
}

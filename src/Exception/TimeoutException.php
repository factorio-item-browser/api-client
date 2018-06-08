<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Exception;

use Exception;

/**
 * The exception thrown when the request timed out.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class TimeoutException extends ApiClientException
{
    /**
     * Initializes the exception.
     * @param string $request
     * @param Exception $previous
     */
    public function __construct(string $request, Exception $previous = null)
    {
        parent::__construct('Requested timed out.', 408, $request, '', $previous);
    }
}

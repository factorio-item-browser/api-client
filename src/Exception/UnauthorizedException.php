<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Exception;

use Throwable;

/**
 * The exception is thrown when a 401 Unauthorized is encountered.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class UnauthorizedException extends ErrorResponseException
{
    public function __construct(string $message, string $request, string $response = '', Throwable $previous = null)
    {
        parent::__construct($message, 401, $request, $response, $previous);
    }
}

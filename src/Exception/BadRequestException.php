<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Exception;

use Throwable;

/**
 * The exception thrown when a 400 Bad Request is encountered.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class BadRequestException extends ErrorResponseException
{
    public function __construct(string $message, string $request, string $response = '', Throwable $previous = null)
    {
        parent::__construct($message, 400, $request, $response, $previous);
    }
}

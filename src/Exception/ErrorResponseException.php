<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Exception;

use Throwable;

/**
 * The exception thrown when the response had an erroneous status code.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ErrorResponseException extends ClientException
{
    private const MESSAGE = 'The request returned a status code %d: %s';

    public function __construct(
        string $message,
        int $statusCode,
        string $request,
        string $response,
        ?Throwable $previous = null
    ) {
        parent::__construct(sprintf(self::MESSAGE, $statusCode, $message), $statusCode, $request, $response, $previous);
    }
}

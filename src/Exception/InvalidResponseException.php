<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Exception;

use Throwable;

/**
 * The exception thrown when an invalid response is encountered.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class InvalidResponseException extends ClientException
{
    private const MESSAGE = 'The response could not be parsed: %s';

    public function __construct(string $message, string $request, string $response, ?Throwable $previous = null)
    {
        parent::__construct(sprintf(self::MESSAGE, $message), 500, $request, $response, $previous);
    }
}

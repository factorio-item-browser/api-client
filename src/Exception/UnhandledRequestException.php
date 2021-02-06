<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Exception;

use Throwable;

/**
 * The exception thrown when an unhandled request was encountered.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class UnhandledRequestException extends ClientException
{
    private const MESSAGE = 'The request %s is not handled by any endpoint.';

    public function __construct(string $requestClass, ?Throwable $previous = null)
    {
        parent::__construct(sprintf(self::MESSAGE, $requestClass), 0, '', '', $previous);
    }
}

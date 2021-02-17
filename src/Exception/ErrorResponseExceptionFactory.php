<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Exception;

use Throwable;

/**
 * The factory for creating the correct error response instance.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ErrorResponseExceptionFactory
{
    public static function create(
        int $statusCode,
        string $message,
        string $request,
        string $response,
        ?Throwable $previous = null
    ): ClientException {
        switch ($statusCode) {
            case 400:
                $exception = new BadRequestException($message, $request, $response, $previous);
                break;
            case 401:
                $exception = new UnauthorizedException($message, $request, $response, $previous);
                break;
            case 404:
                $exception = new NotFoundException($message, $request, $response, $previous);
                break;
            default:
                $exception = new ErrorResponseException($message, $statusCode, $request, $response, $previous);
                break;
        }
        return $exception;
    }
}

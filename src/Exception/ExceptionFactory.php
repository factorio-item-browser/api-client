<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Exception;

/**
 * The factory for creating actual exceptions.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ExceptionFactory
{
    /**
     * Creates the exception corresponding to the specified status code.
     * @param int $statusCode
     * @param string $message
     * @param string $request
     * @param string $response
     * @return ApiClientException
     */
    public static function create(
        int $statusCode,
        string $message,
        string $request,
        string $response
    ): ApiClientException {
        switch ($statusCode) {
            case 400:
                $exception = new BadRequestException($message, $request, $response);
                break;
            case 401:
                $exception = new UnauthorizedException($message, $request, $response);
                break;
            case 403:
                $exception = new ForbiddenException($message, $request, $response);
                break;
            case 404:
                $exception = new NotFoundException($message, $request, $response);
                break;
            case 408:
                $exception = new TimeoutException($request);
                break;
            default:
                $exception = new ApiClientException($message, $statusCode, $request, $response);
                break;
        }
        return $exception;
    }
}

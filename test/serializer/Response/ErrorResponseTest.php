<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\Api\Client\Response;

use FactorioItemBrowser\Api\Client\Entity\Error;
use FactorioItemBrowser\Api\Client\Response\ErrorResponse;
use FactorioItemBrowserTestSerializer\Api\Client\SerializerTestCase;

/**
 * The PHPUnit test of serializing the ErrorResponse class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversNothing
 */
class ErrorResponseTest extends SerializerTestCase
{
    /**
     * Returns the object to be serialized or deserialized.
     * @return object
     */
    protected function getObject(): object
    {
        $error = new Error();
        $error->setMessage('abc');

        $result = new ErrorResponse();
        $result->setError($error);

        return $result;
    }

    /**
     * Returns the serialized data.
     * @return array<mixed>
     */
    protected function getData(): array
    {
        return [
            'error' => [
                'message' => 'abc',
            ],
        ];
    }
}

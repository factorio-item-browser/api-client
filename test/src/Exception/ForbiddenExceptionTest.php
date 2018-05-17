<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Exception;

use Exception;
use FactorioItemBrowser\Api\Client\Exception\ForbiddenException;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the forbidden exception class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Exception\ForbiddenException
 */
class ForbiddenExceptionTest extends TestCase
{
    /**
     * Tests the constructing.
     * @covers ::__construct
     */
    public function testConstruct()
    {
        $message = 'abc';
        $code = 403;
        $request = 'def';
        $response = 'ghi';
        $previous = new Exception('jkl');

        $exception = new ForbiddenException($message, $request, $response, $previous);

        $this->assertEquals($message, $exception->getMessage());
        $this->assertEquals($code, $exception->getCode());
        $this->assertEquals($request, $exception->getRequest());
        $this->assertEquals($response, $exception->getResponse());
        $this->assertEquals($previous, $exception->getPrevious());
    }
}

<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Endpoint\Generic;

use FactorioItemBrowser\Api\Client\Endpoint\Generic\GenericDetailsEndpoint;
use FactorioItemBrowser\Api\Client\Request\Generic\GenericDetailsRequest;
use FactorioItemBrowser\Api\Client\Response\Generic\GenericDetailsResponse;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the GenericDetailsEndpoint class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @covers \FactorioItemBrowser\Api\Client\Endpoint\Generic\GenericDetailsEndpoint
 */
class GenericDetailsEndpointTest extends TestCase
{
    public function test(): void
    {
        $request = new GenericDetailsRequest();
        $request->combinationId = 'abc';

        $instance = new GenericDetailsEndpoint();
        $this->assertSame(GenericDetailsRequest::class, $instance->getHandledRequestClass());
        $this->assertSame('abc/generic/details', $instance->getRequestPath($request));
        $this->assertSame(GenericDetailsResponse::class, $instance->getResponseClass());
    }
}

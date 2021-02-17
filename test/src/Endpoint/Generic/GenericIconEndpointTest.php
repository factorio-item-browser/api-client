<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Endpoint\Generic;

use FactorioItemBrowser\Api\Client\Endpoint\Generic\GenericIconEndpoint;
use FactorioItemBrowser\Api\Client\Request\Generic\GenericIconRequest;
use FactorioItemBrowser\Api\Client\Response\Generic\GenericIconResponse;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the GenericIconEndpoint class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @covers \FactorioItemBrowser\Api\Client\Endpoint\Generic\GenericIconEndpoint
 */
class GenericIconEndpointTest extends TestCase
{
    public function test(): void
    {
        $request = new GenericIconRequest();
        $request->combinationId = 'abc';

        $instance = new GenericIconEndpoint();
        $this->assertSame(GenericIconRequest::class, $instance->getHandledRequestClass());
        $this->assertSame('abc/generic/icon', $instance->getRequestPath($request));
        $this->assertSame(GenericIconResponse::class, $instance->getResponseClass());
    }
}

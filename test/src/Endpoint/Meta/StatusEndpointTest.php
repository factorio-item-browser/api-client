<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Endpoint\Meta;

use FactorioItemBrowser\Api\Client\Endpoint\Meta\StatusEndpoint;
use FactorioItemBrowser\Api\Client\Request\Meta\StatusRequest;
use FactorioItemBrowser\Api\Client\Response\Meta\StatusResponse;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the StatusEndpoint class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 *
 * @covers \FactorioItemBrowser\Api\Client\Endpoint\Meta\StatusEndpoint
 */
class StatusEndpointTest extends TestCase
{
    public function test(): void
    {
        $request = new StatusRequest();
        $request->combinationId = 'abc';

        $instance = new StatusEndpoint();
        $this->assertSame(StatusRequest::class, $instance->getHandledRequestClass());
        $this->assertSame('abc', $instance->getRequestPath($request));
        $this->assertSame(StatusResponse::class, $instance->getResponseClass());
    }
}

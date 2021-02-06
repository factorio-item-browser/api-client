<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Endpoint\Recipe;

use FactorioItemBrowser\Api\Client\Endpoint\Recipe\RecipeMachinesEndpoint;
use FactorioItemBrowser\Api\Client\Request\Recipe\RecipeMachinesRequest;
use FactorioItemBrowser\Api\Client\Response\Recipe\RecipeMachinesResponse;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the RecipeMachinesEndpoint class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @covers \FactorioItemBrowser\Api\Client\Endpoint\Recipe\RecipeMachinesEndpoint
 */
class RecipeMachinesEndpointTest extends TestCase
{
    public function test(): void
    {
        $request = new RecipeMachinesRequest();
        $request->combinationId = 'abc';

        $instance = new RecipeMachinesEndpoint();
        $this->assertSame(RecipeMachinesRequest::class, $instance->getHandledRequestClass());
        $this->assertSame('abc/recipe/machines', $instance->getRequestPath($request));
        $this->assertSame(RecipeMachinesResponse::class, $instance->getResponseClass());
    }
}

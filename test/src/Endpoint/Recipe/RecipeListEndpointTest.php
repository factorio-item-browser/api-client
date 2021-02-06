<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Endpoint\Recipe;

use FactorioItemBrowser\Api\Client\Endpoint\Recipe\RecipeListEndpoint;
use FactorioItemBrowser\Api\Client\Request\Recipe\RecipeListRequest;
use FactorioItemBrowser\Api\Client\Response\Recipe\RecipeListResponse;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the RecipeListEndpoint class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @covers \FactorioItemBrowser\Api\Client\Endpoint\Recipe\RecipeListEndpoint
 */
class RecipeListEndpointTest extends TestCase
{
    public function test(): void
    {
        $request = new RecipeListRequest();
        $request->combinationId = 'abc';

        $instance = new RecipeListEndpoint();
        $this->assertSame(RecipeListRequest::class, $instance->getHandledRequestClass());
        $this->assertSame('abc/recipe/list', $instance->getRequestPath($request));
        $this->assertSame(RecipeListResponse::class, $instance->getResponseClass());
    }
}

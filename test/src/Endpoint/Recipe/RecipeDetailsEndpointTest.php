<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Endpoint\Recipe;

use FactorioItemBrowser\Api\Client\Endpoint\Recipe\RecipeDetailsEndpoint;
use FactorioItemBrowser\Api\Client\Request\Recipe\RecipeDetailsRequest;
use FactorioItemBrowser\Api\Client\Response\Recipe\RecipeDetailsResponse;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the RecipeDetailsEndpoint class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @covers \FactorioItemBrowser\Api\Client\Endpoint\Recipe\RecipeDetailsEndpoint
 */
class RecipeDetailsEndpointTest extends TestCase
{
    public function test(): void
    {
        $request = new RecipeDetailsRequest();
        $request->combinationId = 'abc';

        $instance = new RecipeDetailsEndpoint();
        $this->assertSame(RecipeDetailsRequest::class, $instance->getHandledRequestClass());
        $this->assertSame('abc/recipe/details', $instance->getRequestPath($request));
        $this->assertSame(RecipeDetailsResponse::class, $instance->getResponseClass());
    }
}

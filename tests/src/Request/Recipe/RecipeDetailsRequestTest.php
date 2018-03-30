<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Request\Recipe;

use FactorioItemBrowser\Api\Client\Request\Recipe\RecipeDetailsRequest;
use FactorioItemBrowser\Api\Client\Response\Recipe\RecipeDetailsResponse;
use FactorioItemBrowserTestAsset\Api\Client\Response\TestPendingResponse;
use PHPUnit\Framework\TestCase;

/**
 * The PHPunit test of the recipe details request class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Request\Recipe\RecipeDetailsRequest
 */
class RecipeDetailsRequestTest extends TestCase
{
    /**
     * Tests getting the request path.
     * @covers ::getRequestPath
     */
    public function testGetRequestPath()
    {
        $request = new RecipeDetailsRequest();
        $this->assertEquals('/recipe/details', $request->getRequestPath());
    }

    /**
     * Tests getting the request data.
     * @covers ::getRequestData
     * @covers ::setNames
     * @covers ::addName
     */
    public function testGetRequestData()
    {
        $request = new RecipeDetailsRequest();
        $this->assertEquals($request, $request->setNames(['abc', 42, '', 'def']));
        $this->assertEquals($request, $request->addName('ghi'));

        $expectedData = [
            'names' => ['abc', '42', 'def', 'ghi']
        ];
        $this->assertEquals($expectedData, $request->getRequestData());
    }

    /**
     * Tests creating the response.
     * @covers ::createResponse
     */
    public function testCreateResponse()
    {
        $request = new RecipeDetailsRequest();
        $this->assertInstanceOf(RecipeDetailsResponse::class, $request->createResponse(new TestPendingResponse()));
    }
}

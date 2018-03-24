<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Request\Item;

use FactorioItemBrowser\Api\Client\Request\Item\ItemRandomRequest;
use FactorioItemBrowser\Api\Client\Response\Item\ItemRandomResponse;
use FactorioItemBrowserTestAsset\Api\Client\Response\TestPendingResponse;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the item random request class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass FactorioItemBrowser\Api\Client\Request\Item\ItemRandomRequest
 */
class ItemRandomRequestTest extends TestCase
{
    /**
     * Tests getting the request path.
     * @covers ::getRequestPath
     */
    public function testGetRequestPath()
    {
        $request = new ItemRandomRequest();
        $this->assertEquals('/item/random', $request->getRequestPath());
    }

    /**
     * Tests getting the request data.
     * @covers ::getRequestData
     * @covers ::setNumberOfResults
     * @covers ::setNumberOfRecipesPerResult
     */
    public function testGetRequestData()
    {
        $request = new ItemRandomRequest();
        $this->assertEquals($request, $request->setNumberOfResults(42));
        $this->assertEquals($request, $request->setNumberOfRecipesPerResult(1337));

        $expectedData = [
            'numberOfResults' => 42,
            'numberOfRecipesPerResult' => 1337
        ];
        $this->assertEquals($expectedData, $request->getRequestData());
    }

    /**
     * Tests creating the response.
     * @covers ::createResponse
     */
    public function testCreateResponse()
    {
        $request = new ItemRandomRequest();
        $this->assertInstanceOf(ItemRandomResponse::class, $request->createResponse(new TestPendingResponse()));
    }
}

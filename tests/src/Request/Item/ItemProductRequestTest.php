<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Request\Item;

use FactorioItemBrowser\Api\Client\Request\Item\ItemProductRequest;
use FactorioItemBrowser\Api\Client\Response\Item\ItemProductResponse;
use FactorioItemBrowserTestAsset\Api\Client\Response\TestPendingResponse;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the item product request class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass FactorioItemBrowser\Api\Client\Request\Item\ItemProductRequest
 */
class ItemProductRequestTest extends TestCase
{
    /**
     * Tests getting the request path.
     * @covers ::getRequestPath
     */
    public function testGetRequestPath()
    {
        $request = new ItemProductRequest();
        $this->assertEquals('/item/product', $request->getRequestPath());
    }

    /**
     * Tests getting the request data.
     * @covers ::getRequestData
     * @covers ::setType
     * @covers ::setName
     * @covers ::setNumberOfResults
     * @covers ::setIndexOfFirstResult
     */
    public function testGetRequestData()
    {
        $request = new ItemProductRequest();
        $this->assertEquals($request, $request->setType('abc'));
        $this->assertEquals($request, $request->setName('def'));
        $this->assertEquals($request, $request->setNumberOfResults(42));
        $this->assertEquals($request, $request->setIndexOfFirstResult(21));

        $expectedData = [
            'type' => 'abc',
            'name' => 'def',
            'numberOfResults' => 42,
            'indexOfFirstResult' => 21
        ];
        $this->assertEquals($expectedData, $request->getRequestData());
    }

    /**
     * Tests creating the response.
     * @covers ::createResponse
     */
    public function testCreateResponse()
    {
        $request = new ItemProductRequest();
        $this->assertInstanceOf(ItemProductResponse::class, $request->createResponse(new TestPendingResponse()));
    }
}

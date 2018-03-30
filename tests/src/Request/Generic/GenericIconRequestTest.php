<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Request\Generic;

use FactorioItemBrowser\Api\Client\Request\Generic\GenericIconRequest;
use FactorioItemBrowser\Api\Client\Response\Generic\GenericIconResponse;
use FactorioItemBrowserTestAsset\Api\Client\Response\TestPendingResponse;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the generic icon request class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Request\Generic\GenericIconRequest
 */
class GenericIconRequestTest extends TestCase
{
    /**
     * Tests getting the request path.
     * @covers ::getRequestPath
     */
    public function testGetRequestPath()
    {
        $request = new GenericIconRequest();
        $this->assertEquals('/generic/icon', $request->getRequestPath());
    }

    /**
     * Tests getting the request data.
     * @covers ::getRequestData
     * @covers ::addEntity
     */
    public function testGetRequestData()
    {
        $request = new GenericIconRequest();
        $this->assertEquals($request, $request->addEntity('abc', 'def'));
        $this->assertEquals($request, $request->addEntity('ghi', 'jkl'));

        $expectedData = [
            'entities' => [
                ['type' => 'abc', 'name' => 'def'],
                ['type' => 'ghi', 'name' => 'jkl']
            ]
        ];
        $this->assertEquals($expectedData, $request->getRequestData());
    }

    /**
     * Tests creating the response.
     * @covers ::createResponse
     */
    public function testCreateResponse()
    {
        $request = new GenericIconRequest();
        $this->assertInstanceOf(GenericIconResponse::class, $request->createResponse(new TestPendingResponse()));
    }
}

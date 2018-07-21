<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Request\Generic;

use FactorioItemBrowser\Api\Client\Request\Generic\GenericDetailsRequest;
use FactorioItemBrowser\Api\Client\Response\Generic\GenericDetailsResponse;
use FactorioItemBrowserTestAsset\Api\Client\Response\TestPendingResponse;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the generic details request class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Request\Generic\GenericDetailsRequest
 */
class GenericDetailsRequestTest extends TestCase
{
    /**
     * Tests getting the request path.
     * @covers ::getRequestPath
     */
    public function testGetRequestPath()
    {
        $request = new GenericDetailsRequest();
        $this->assertSame('/generic/details', $request->getRequestPath());
    }

    /**
     * Tests getting the request data.
     * @covers ::getRequestData
     * @covers ::addEntity
     */
    public function testGetRequestData()
    {
        $request = new GenericDetailsRequest();
        $this->assertSame($request, $request->addEntity('abc', 'def'));
        $this->assertSame($request, $request->addEntity('ghi', 'jkl'));

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
        $request = new GenericDetailsRequest();
        $this->assertInstanceOf(GenericDetailsResponse::class, $request->createResponse(new TestPendingResponse()));
    }
}

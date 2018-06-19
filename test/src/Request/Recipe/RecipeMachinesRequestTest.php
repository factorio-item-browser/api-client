<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Request\Recipe;

use FactorioItemBrowser\Api\Client\Request\Recipe\RecipeMachinesRequest;
use FactorioItemBrowser\Api\Client\Response\Recipe\RecipeMachinesResponse;
use FactorioItemBrowserTestAsset\Api\Client\Response\TestPendingResponse;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the recipe machines request class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Request\Recipe\RecipeMachinesRequest
 */
class RecipeMachinesRequestTest extends TestCase
{
    /**
     * Tests getting the request path.
     * @covers ::getRequestPath
     */
    public function testGetRequestPath()
    {
        $request = new RecipeMachinesRequest();
        $this->assertSame('/recipe/machines', $request->getRequestPath());
    }

    /**
     * Tests getting the request data.
     * @covers ::getRequestData
     * @covers ::setName
     * @covers ::setNumberOfResults
     * @covers ::setIndexOfFirstResult
     */
    public function testGetRequestData()
    {
        $request = new RecipeMachinesRequest();
        $this->assertSame($request, $request->setName('abc'));
        $this->assertSame($request, $request->setNumberOfResults(42));
        $this->assertSame($request, $request->setIndexOfFirstResult(21));

        $expectedData = [
            'name' => 'abc',
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
        $request = new RecipeMachinesRequest();
        $this->assertInstanceOf(RecipeMachinesResponse::class, $request->createResponse(new TestPendingResponse()));
    }
}

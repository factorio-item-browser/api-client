<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Request\Mod;

use BluePsyduck\MultiCurl\Entity\Request;
use FactorioItemBrowser\Api\Client\Client\Client;
use FactorioItemBrowser\Api\Client\Client\Options;
use FactorioItemBrowser\Api\Client\Request\Mod\ModMetaRequest;
use FactorioItemBrowser\Api\Client\Response\Mod\ModMetaResponse;
use FactorioItemBrowser\Api\Client\Response\PendingResponse;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the mod meta request class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Request\Mod\ModMetaRequest
 */
class ModMetaRequestTest extends TestCase
{
    /**
     * Tests getting the request path.
     * @covers ::getRequestPath
     */
    public function testGetRequestPath()
    {
        $request = new ModMetaRequest();
        $this->assertSame('/mod/meta', $request->getRequestPath());
    }

    /**
     * Tests getting the request data.
     * @covers ::getRequestData
     */
    public function testGetRequestData()
    {
        $request = new ModMetaRequest();
        $this->assertEquals([], $request->getRequestData());
    }

    /**
     * Tests creating the response.
     * @covers ::createResponse
     */
    public function testCreateResponse()
    {
        $pendingResponse = new PendingResponse(new Client(new Options()), new Request());
        $request = new ModMetaRequest();
        $this->assertInstanceOf(ModMetaResponse::class, $request->createResponse($pendingResponse));
    }
}

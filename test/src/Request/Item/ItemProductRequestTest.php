<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Request\Item;

use FactorioItemBrowser\Api\Client\Request\Item\ItemProductRequest;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the item product request class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Request\Item\ItemProductRequest
 */
class ItemProductRequestTest extends TestCase
{
    /**
     * Tests the setting and getting the type.
     * @covers ::getType
     * @covers ::setType
     */
    public function testSetAndGetType(): void
    {
        $type = 'abc';
        $request = new ItemProductRequest();

        $this->assertSame($request, $request->setType($type));
        $this->assertSame($type, $request->getType());
    }

    /**
     * Tests the setting and getting the name.
     * @covers ::getName
     * @covers ::setName
     */
    public function testSetAndGetName(): void
    {
        $name = 'abc';
        $request = new ItemProductRequest();

        $this->assertSame($request, $request->setName($name));
        $this->assertSame($name, $request->getName());
    }

    /**
     * Tests the setting and getting the number of results.
     * @covers ::getNumberOfResults
     * @covers ::setNumberOfResults
     */
    public function testSetAndGetNumberOfResults(): void
    {
        $numberOfResults = 42;
        $request = new ItemProductRequest();

        $this->assertSame($request, $request->setNumberOfResults($numberOfResults));
        $this->assertSame($numberOfResults, $request->getNumberOfResults());
    }

    /**
     * Tests the setting and getting the index of first result.
     * @covers ::getIndexOfFirstResult
     * @covers ::setIndexOfFirstResult
     */
    public function testSetAndGetIndexOfFirstResult(): void
    {
        $indexOfFirstResult = 42;
        $request = new ItemProductRequest();

        $this->assertSame($request, $request->setIndexOfFirstResult($indexOfFirstResult));
        $this->assertSame($indexOfFirstResult, $request->getIndexOfFirstResult());
    }
}

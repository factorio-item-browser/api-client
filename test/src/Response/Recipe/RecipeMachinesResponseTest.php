<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Response\Recipe;

use FactorioItemBrowser\Api\Client\Entity\Machine;
use FactorioItemBrowser\Api\Client\Entity\Meta;
use FactorioItemBrowser\Api\Client\Response\Recipe\RecipeMachinesResponse;
use FactorioItemBrowserTestAsset\Api\Client\Response\TestPendingResponse;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the recipe machines response class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Response\Recipe\RecipeMachinesResponse
 */
class RecipeMachinesResponseTest extends TestCase
{
    /**
     * Tests mapping and getting the machines.
     * @covers ::getMachines
     * @covers ::mapResponse
     */
    public function testGetMachines()
    {
        $responseData = [
            'machines' => [
                ['name' => 'abc'],
                ['name' => 'def']
            ]
        ];
        $machine1 = new Machine();
        $machine1->setName('abc');
        $machine2 = new Machine();
        $machine2->setName('def');

        $response = new RecipeMachinesResponse(new TestPendingResponse($responseData));
        $this->assertEquals([$machine1, $machine2], $response->getMachines());
    }
    
    /**
     * Tests mapping and getting the total number of results.
     * @covers ::getTotalNumberOfResults
     * @covers ::mapResponse
     */
    public function testGetTotalNumberOfResults()
    {
        $responseData = [
            'totalNumberOfResults' => 42
        ];

        $response = new RecipeMachinesResponse(new TestPendingResponse($responseData));
        $this->assertEquals(42, $response->getTotalNumberOfResults());
    }

    /**
     * Tests mapping and getting the meta data.
     * @coversNothing
     */
    public function testGetMeta()
    {
        $responseData = [
            'meta' => [
                'executionTime' => 13.37
            ]
        ];
        $expectedMeta = new Meta();
        $expectedMeta->setExecutionTime(13.37);

        $response = new RecipeMachinesResponse(new TestPendingResponse($responseData));
        $this->assertEquals($expectedMeta, $response->getMeta());
    }
}

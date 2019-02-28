<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Response\Recipe;

use FactorioItemBrowser\Api\Client\Entity\Machine;
use FactorioItemBrowser\Api\Client\Response\Recipe\RecipeMachinesResponse;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use ReflectionException;

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
     * Tests the constructing.
     * @coversNothing
     */
    public function testConstruct(): void
    {
        $response = new RecipeMachinesResponse();

        $this->assertSame([], $response->getMachines());
        $this->assertSame(0, $response->getTotalNumberOfResults());
    }

    /**
     * Tests setting, adding and getting the machines.
     * @throws ReflectionException
     * @covers ::addMachine
     * @covers ::setMachines
     * @covers ::getMachines
     */
    public function testSetAddAndGetMachines(): void
    {
        /* @var Machine&MockObject $machine1 */
        $machine1 = $this->createMock(Machine::class);
        /* @var Machine&MockObject $machine2 */
        $machine2 = $this->createMock(Machine::class);
        /* @var Machine&MockObject $machine3 */
        $machine3 = $this->createMock(Machine::class);

        $response = new RecipeMachinesResponse();
        $this->assertSame($response, $response->setMachines([$machine1, $machine2]));
        $this->assertSame([$machine1, $machine2], $response->getMachines());

        $this->assertSame($response, $response->addMachine($machine3));
        $this->assertSame([$machine1, $machine2, $machine3], $response->getMachines());
    }

    /**
     * Tests the setting and getting the total number of results.
     * @covers ::getTotalNumberOfResults
     * @covers ::setTotalNumberOfResults
     */
    public function testSetAndGetTotalNumberOfResults(): void
    {
        $totalNumberOfResults = 42;
        $response = new RecipeMachinesResponse();

        $this->assertSame($response, $response->setTotalNumberOfResults($totalNumberOfResults));
        $this->assertSame($totalNumberOfResults, $response->getTotalNumberOfResults());
    }
}

<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Response\Generic;

use FactorioItemBrowser\Api\Client\Entity\GenericEntity;
use FactorioItemBrowser\Api\Client\Response\Generic\GenericDetailsResponse;
use FactorioItemBrowserTestAsset\Api\Client\Response\TestPendingResponse;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the generic details response class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Response\Generic\GenericDetailsResponse
 */
class GenericDetailsResponseTest extends TestCase
{
    /**
     * Tests mapping and getting entities.
     * @covers ::getEntities
     * @covers ::mapResponse
     */
    public function testGetEntities()
    {
        $responseData = [
            'entities' => [
                ['name' => 'abc'],
                ['name' => 'def']
            ]
        ];
        $entity1 = new GenericEntity();
        $entity1->setName('abc');
        $entity2 = new GenericEntity();
        $entity2->setName('def');

        $response = new GenericDetailsResponse(new TestPendingResponse($responseData));
        $this->assertEquals([$entity1, $entity2], $response->getEntities());
    }
}

<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Response\Generic;

use FactorioItemBrowser\Api\Client\Entity\GenericEntity;
use FactorioItemBrowser\Api\Client\Entity\Meta;
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
     * Tests mapping and getting the authorization token.
     * @covers ::getEntities
     * @covers ::mapResponse
     */
    public function testGetAuthorizationToken()
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

        $response = new GenericDetailsResponse(new TestPendingResponse($responseData));
        $this->assertEquals($expectedMeta, $response->getMeta());
    }
}

<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Serializer\Listener;

use FactorioItemBrowser\Api\Client\Serializer\Listener\ReducedEntityListener;
use FactorioItemBrowser\Api\Client\Transfer\GenericEntity;
use FactorioItemBrowser\Api\Client\Transfer\GenericEntityWithRecipes;
use JMS\Serializer\EventDispatcher\PreSerializeEvent;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the ReducedEntityListener class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @covers \FactorioItemBrowser\Api\Client\Serializer\Listener\ReducedEntityListener
 */
class ReducedEntityListenerTest extends TestCase
{
    public function testGetSubscribedEvents(): void
    {
        $result = ReducedEntityListener::getSubscribedEvents();

        $this->assertCount(1, $result);
    }

    /**
     * @return array<mixed>
     */
    public function provideOnPreSerialize(): array
    {
        $object1 = new GenericEntityWithRecipes();
        $object1->name = 'abc';

        $object2 = new GenericEntity();
        $object2->name = 'def';

        return [
            [$object1, false],
            [$object2, true],
        ];
    }

    /**
     * @dataProvider provideOnPreSerialize
     */
    public function testOnPreSerialize(object $object, bool $expectSetType): void
    {
        $event = $this->createMock(PreSerializeEvent::class);
        $event->expects($this->any())
              ->method('getObject')
              ->willReturn($object);
        $event->expects($expectSetType ? $this->once() : $this->never())
              ->method('setType')
              ->with($this->identicalTo(GenericEntity::class), $this->identicalTo([]));

        $listener = new ReducedEntityListener();
        $listener->onPreSerialize($event);
    }
}

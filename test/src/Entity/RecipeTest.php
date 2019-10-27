<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Entity;

use FactorioItemBrowser\Api\Client\Entity\Item;
use FactorioItemBrowser\Api\Client\Entity\Recipe;
use FactorioItemBrowser\Common\Constant\EntityType;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the recipe class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Entity\Recipe
 */
class RecipeTest extends TestCase
{
    /**
     * Tests the constructing.
     * @covers ::getType
     */
    public function testConstruct(): void
    {
        $recipe = new Recipe();

        $this->assertSame(EntityType::RECIPE, $recipe->getType());
        $this->assertSame('', $recipe->getName());
        $this->assertSame('', $recipe->getMode());
        $this->assertSame('', $recipe->getLabel());
        $this->assertSame('', $recipe->getDescription());
        $this->assertSame([], $recipe->getIngredients());
        $this->assertSame([], $recipe->getProducts());
        $this->assertSame(0., $recipe->getCraftingTime());
    }

    /**
     * Tests the setting and getting the mode.
     * @covers ::getMode
     * @covers ::setMode
     */
    public function testSetAndGetMode(): void
    {
        $mode = 'abc';
        $entity = new Recipe();

        $this->assertSame($entity, $entity->setMode($mode));
        $this->assertSame($mode, $entity->getMode());
    }

    /**
     * Tests setting, adding and getting the ingredients.
     * @covers ::addIngredient
     * @covers ::setIngredients
     * @covers ::getIngredients
     */
    public function testSetAddAndGetIngredients(): void
    {
        /* @var Item&MockObject $item1 */
        $item1 = $this->createMock(Item::class);
        /* @var Item&MockObject $item2 */
        $item2 = $this->createMock(Item::class);
        /* @var Item&MockObject $item3 */
        $item3 = $this->createMock(Item::class);

        $recipe = new Recipe();
        $this->assertSame($recipe, $recipe->setIngredients([$item1, $item2]));
        $this->assertSame([$item1, $item2], $recipe->getIngredients());

        $this->assertSame($recipe, $recipe->addIngredient($item3));
        $this->assertSame([$item1, $item2, $item3], $recipe->getIngredients());
    }

    /**
     * Tests setting, adding and getting the products.
     * @covers ::addProduct
     * @covers ::setProducts
     * @covers ::getProducts
     */
    public function testSetAddAndGetProducts(): void
    {
        /* @var Item&MockObject $item1 */
        $item1 = $this->createMock(Item::class);
        /* @var Item&MockObject $item2 */
        $item2 = $this->createMock(Item::class);
        /* @var Item&MockObject $item3 */
        $item3 = $this->createMock(Item::class);

        $recipe = new Recipe();
        $this->assertSame($recipe, $recipe->setProducts([$item1, $item2]));
        $this->assertSame([$item1, $item2], $recipe->getProducts());

        $this->assertSame($recipe, $recipe->addProduct($item3));
        $this->assertSame([$item1, $item2, $item3], $recipe->getProducts());
    }

    /**
     * Tests the setting and getting the crafting time.
     * @covers ::getCraftingTime
     * @covers ::setCraftingTime
     */
    public function testSetAndGetCraftingTime(): void
    {
        $craftingTime = 13.37;
        $entity = new Recipe();

        $this->assertSame($entity, $entity->setCraftingTime($craftingTime));
        $this->assertSame($craftingTime, $entity->getCraftingTime());
    }
}

<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Response\Recipe;

use BluePsyduck\Common\Data\DataContainer;
use FactorioItemBrowser\Api\Client\Entity\RecipeWithExpensiveVersion;
use FactorioItemBrowser\Api\Client\Exception\ApiClientException;
use FactorioItemBrowser\Api\Client\Response\AbstractResponse;

/**
 * The response of the recipe details request.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class RecipeDetailsResponse extends AbstractResponse
{
    /**
     * The recipes details.
     * @var array|RecipeWithExpensiveVersion[]
     */
    protected $recipes;

    /**
     * Returns the recipe details.
     * @return array|RecipeWithExpensiveVersion[]
     * @throws ApiClientException
     */
    public function getRecipes()
    {
        $this->checkPendingResponse();
        return $this->recipes;
    }

    /**
     * Maps the response data.
     * @param DataContainer $responseData
     * @return $this
     */
    protected function mapResponse(DataContainer $responseData)
    {
        $this->recipes = [];
        foreach ($responseData->getObjectArray('recipes') as $recipeData) {
            $this->recipes[] = (new RecipeWithExpensiveVersion())->readData($recipeData);
        }
        return $this;
    }
}

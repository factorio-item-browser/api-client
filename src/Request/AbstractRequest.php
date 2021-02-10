<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Request;

/**
 * The abstract class of all requests.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
abstract class AbstractRequest
{
    /**
     * The ID of the combination to use for the request.
     * @var string
     */
    public string $combinationId = '';

    /**
     * The language code to use for translating labels and descriptions.
     * @var string
     */
    public string $locale = '';
}

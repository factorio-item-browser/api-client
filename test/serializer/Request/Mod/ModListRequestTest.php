<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\Api\Client\Request\Mod;

use FactorioItemBrowser\Api\Client\Request\Mod\ModListRequest;
use FactorioItemBrowserTestSerializer\Api\Client\SerializerTestCase;

/**
 * The serializer test of the ModListRequest class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ModListRequestTest extends SerializerTestCase
{
    protected function getObject(): object
    {
        return new ModListRequest();
    }

    protected function getData(): array
    {
        return [
        ];
    }
}

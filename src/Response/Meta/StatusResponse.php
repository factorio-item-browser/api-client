<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Response\Meta;

use DateTimeInterface;
use JMS\Serializer\Annotation\Type;

/**
 * The response of the status request.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class StatusResponse
{
    /**
     * The version of the data available in the API.
     */
    public int $dataVersion = 0;

    /**
     * The time when the data of the combination was imported into the database.
     */
    #[Type('DateTimeInterface<"Y-m-d\TH:i:sP">')]
    public DateTimeInterface $importTime;
}

<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Constant;

/**
 * The units of the energy usage.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class EnergyUsageUnit
{
    /**
     * The basic unit.
     */
    const WATT = 'W';

    /**
     * A thousand watt.
     */
    const KILOWATT = 'kW';

    /**
     * A million watt.
     */
    const MEGAWATT = 'MW';

    /**
     * A billion watt.
     */
    const GIGAWATT = 'GW';

    /**
     * A trillion watt.
     */
    const TERAWATT = 'TW';

    /**
     * A quadrillion watt.
     */
    const PETAWATT = 'PW';

    /**
     * A quintillion watt.
     */
    const EXAWATT = 'EW';

    /**
     * A sextillion watt
     */
    const ZETTAWATT = 'ZW';

    /**
     * Quite a lot of watt.
     */
    const YOTTAWATT = 'YW';
}
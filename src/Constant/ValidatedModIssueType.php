<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Constant;

/**
 * The issue types of the validated mods.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
interface ValidatedModIssueType
{
    /**
     * The mod is in conflict with another mod.
     */
    public const CONFLICT = 'conflict';

    /**
     * The mod is missing a mandatory dependency.
     */
    public const MISSING_DEPENDENCY = 'missing-dependency';

    /**
     * The mod is missing a valid release which can be used.
     */
    public const MISSING_RELEASE = 'missing-release';

    /**
     * The mod does not have any issues.
     */
    public const NONE = 'none';

    /**
     * The mod was not found in the mod portal.
     */
    public const NOT_FOUND = 'not-found';
}

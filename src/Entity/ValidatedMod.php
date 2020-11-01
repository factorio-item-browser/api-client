<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Entity;

use FactorioItemBrowser\Api\Client\Constant\ValidatedModIssueType;

/**
 * The entity representing a validated mod.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ValidatedMod
{
    /**
     * The name of the mod.
     * @var string
     */
    protected $name = '';

    /**
     * The version of the mod used for validation.
     * @var string
     */
    protected $version = '';

    /**
     * The type of issue the mod has.
     * @var string
     */
    protected $issueType = ValidatedModIssueType::NONE;

    /**
     * The dependency which triggered the "missing-dependency" or "conflict" issue.
     * @var string
     */
    protected $issueDependency = '';

    /**
     * Sets the name of the mod.
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Returns the name of the mod.
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets the version of the mod used for validation.
     * @param string $version
     * @return $this
     */
    public function setVersion(string $version): self
    {
        $this->version = $version;
        return $this;
    }

    /**
     * Returns the version of the mod used for validation.
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * Sets the type of issue the mod has.
     * @param string $issueType
     * @return $this
     */
    public function setIssueType(string $issueType): self
    {
        $this->issueType = $issueType;
        return $this;
    }

    /**
     * Returns the type of issue the mod has.
     * @return string
     */
    public function getIssueType(): string
    {
        return $this->issueType;
    }

    /**
     * Sets the dependency which triggered the "missing-dependency" or "conflict" issue.
     * @param string $issueDependency
     * @return $this
     */
    public function setIssueDependency(string $issueDependency): self
    {
        $this->issueDependency = $issueDependency;
        return $this;
    }

    /**
     * Returns the dependency which triggered the "missing-dependency" or "conflict" issue.
     * @return string
     */
    public function getIssueDependency(): string
    {
        return $this->issueDependency;
    }
}

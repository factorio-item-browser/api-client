<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Entity;

use FactorioItemBrowser\Common\Constant\EntityType;

/**
 * The entity representing a mod.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Mod extends GenericEntity
{
    /**
     * The author of the mod.
     * @var string
     */
    protected $author = '';

    /**
     * The version of the mod.
     * @var string
     */
    protected $version = '';

    /**
     * Whether the mod is currently enabled.
     * @var bool
     */
    protected $isEnabled = false;

    /**
     * Returns the type of the entity.
     * @return string
     */
    public function getType(): string
    {
        return EntityType::MOD;
    }

    /**
     * Sets the author of the mod.
     * @param string $author
     * @return $this Implementing fluent interface.
     */
    public function setAuthor(string $author): self
    {
        $this->author = $author;
        return $this;
    }

    /**
     * Returns the author of the mod.
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * Sets the version of the mod.
     * @param string $version
     * @return $this Implementing fluent interface.
     */
    public function setVersion(string $version): self
    {
        $this->version = $version;
        return $this;
    }

    /**
     * Returns the version of the mod.
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * Sets whether the mod is currently enabled.
     * @param bool $isEnabled
     * @return $this Implementing fluent interface.
     */
    public function setIsEnabled(bool $isEnabled): self
    {
        $this->isEnabled = $isEnabled;
        return $this;
    }

    /**
     * Returns whether the mod is currently enabled.
     * @return bool
     */
    public function getIsEnabled(): bool
    {
        return $this->isEnabled;
    }
}

<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Entity;

use BluePsyduck\Common\Data\DataContainer;

/**
 * The entity representing a mod.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Mod implements EntityInterface, TranslatedEntityInterface
{
    /**
     * The name of the mod.
     * @var string
     */
    protected $name = '';

    /**
     * The translated label of the mod.
     * @var string
     */
    protected $label = '';

    /**
     * The translated description of the mod.
     * @var string
     */
    protected $description = '';

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
     * Sets the name of the mod.
     * @param string $name
     * @return $this Implementing fluent interface.
     */
    public function setName(string $name)
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
     * Sets the translated label of the mod.
     * @param string $label
     * @return $this Implementing fluent interface.
     */
    public function setLabel(string $label)
    {
        $this->label = $label;
        return $this;
    }

    /**
     * Returns the translated label of the mod.
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * Sets the translated description of the mod.
     * @param string $description
     * @return $this Implementing fluent interface.
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Returns the translated description of the mod.
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Sets the author of the mod.
     * @param string $author
     * @return $this Implementing fluent interface.
     */
    public function setAuthor(string $author)
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
    public function setVersion(string $version)
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
    public function setIsEnabled(bool $isEnabled)
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

    /**
     * Returns the translation type of the entity.
     * @return string
     */
    public function getTranslationType(): string
    {
        return 'mod';
    }

    /**
     * Writes the entity data to an array.
     * @return array
     */
    public function writeData(): array
    {
        return [
            'name' => $this->name,
            'label' => $this->label,
            'description' => $this->description,
            'author' => $this->author,
            'version' => $this->version,
            'isEnabled' => $this->isEnabled
        ];
    }

    /**
     * Reads the entity data.
     * @param DataContainer $data
     * @return $this
     */
    public function readData(DataContainer $data)
    {
        $this->name = $data->getString('name');
        $this->label = $data->getString('label');
        $this->description = $data->getString('description');
        $this->author = $data->getString('author');
        $this->version = $data->getString('version');
        $this->isEnabled = $data->getBoolean('isEnabled');
        return $this;
    }
}
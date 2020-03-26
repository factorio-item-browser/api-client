<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Response\Combination;

use FactorioItemBrowser\Api\Client\Entity\ExportJob;
use FactorioItemBrowser\Api\Client\Response\ResponseInterface;

/**
 * The response of the combination status request.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class CombinationStatusResponse implements ResponseInterface
{
    /**
     * The ID of the combination.
     * @var string
     */
    protected $id = '';

    /**
     * The names of the mods in the combination.
     * @var array|string[]
     */
    protected $modNames = [];

    /**
     * The latest export job of the combination.
     * @var ExportJob|null
     */
    protected $latestExportJob;

    /**
     * The latest export job which was successful.
     * @var ExportJob|null
     */
    protected $latestSuccessfulExportJob;

    /**
     * Sets the ID of the combination.
     * @param string $id
     * @return $this
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Returns the ID of the combination.
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Sets the names of the mods in the combination.
     * @param array|string[] $modNames
     * @return $this
     */
    public function setModNames(array $modNames): self
    {
        $this->modNames = $modNames;
        return $this;
    }

    /**
     * Returns the names of the mods in the combination.
     * @return array|string[]
     */
    public function getModNames(): array
    {
        return $this->modNames;
    }

    /**
     * Sets the latest export job of the combination.
     * @param ExportJob|null $latestExportJob
     * @return $this
     */
    public function setLatestExportJob(?ExportJob $latestExportJob): self
    {
        $this->latestExportJob = $latestExportJob;
        return $this;
    }

    /**
     * Returns the latest export job of the combination.
     * @return ExportJob|null
     */
    public function getLatestExportJob(): ?ExportJob
    {
        return $this->latestExportJob;
    }

    /**
     * Sets the latest export job which was successful.
     * @param ExportJob|null $latestSuccessfulExportJob
     * @return $this
     */
    public function setLatestSuccessfulExportJob(?ExportJob $latestSuccessfulExportJob): self
    {
        $this->latestSuccessfulExportJob = $latestSuccessfulExportJob;
        return $this;
    }

    /**
     * Returns the latest export job which was successful.
     * @return ExportJob|null
     */
    public function getLatestSuccessfulExportJob(): ?ExportJob
    {
        return $this->latestSuccessfulExportJob;
    }
}

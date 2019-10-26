<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Entity;

use DateTimeInterface;

/**
 * The class representing an export with its status.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Export
{
    /**
     * The current status of the export process.
     * @var string
     */
    protected $status = '';

    /**
     * The time when the export was triggered and put into the queue.
     * @var DateTimeInterface|null
     */
    protected $creationTime;

    /**
     * The time when the actual export was processed.
     * @var DateTimeInterface|null
     */
    protected $exportTime;

    /**
     * The time when the exported data has been imported to the browser database.
     * @var DateTimeInterface|null
     */
    protected $importTime;

    /**
     * Sets the current status of the export process.
     * @param string $status
     * @return $this
     */
    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Returns the current status of the export process.
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * Sets the time when the export was triggered and put into the queue.
     * @param DateTimeInterface|null $creationTime
     * @return $this
     */
    public function setCreationTime(?DateTimeInterface $creationTime): self
    {
        $this->creationTime = $creationTime;
        return $this;
    }

    /**
     * Returns the time when the export was triggered and put into the queue.
     * @return DateTimeInterface|null
     */
    public function getCreationTime(): ?DateTimeInterface
    {
        return $this->creationTime;
    }

    /**
     * Sets the time when the actual export was processed.
     * @param DateTimeInterface|null $exportTime
     * @return $this
     */
    public function setExportTime(?DateTimeInterface $exportTime): self
    {
        $this->exportTime = $exportTime;
        return $this;
    }

    /**
     * Returns the time when the actual export was processed.
     * @return DateTimeInterface|null
     */
    public function getExportTime(): ?DateTimeInterface
    {
        return $this->exportTime;
    }

    /**
     * Sets the time when the exported data has been imported to the browser database.
     * @param DateTimeInterface|null $importTime
     * @return $this
     */
    public function setImportTime(?DateTimeInterface $importTime): self
    {
        $this->importTime = $importTime;
        return $this;
    }

    /**
     * Returns the time when the exported data has been imported to the browser database.
     * @return DateTimeInterface|null
     */
    public function getImportTime(): ?DateTimeInterface
    {
        return $this->importTime;
    }
}

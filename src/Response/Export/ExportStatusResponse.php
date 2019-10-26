<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Response\Export;

use FactorioItemBrowser\Api\Client\Entity\Export;
use FactorioItemBrowser\Api\Client\Response\ResponseInterface;

/**
 * The response of the export status request.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ExportStatusResponse implements ResponseInterface
{
    /**
     * The export with its status.
     * @var Export
     */
    protected $export;

    /**
     * Initializes the entity.
     */
    public function __construct()
    {
        $this->export = new Export();
    }

    /**
     * Sets the export with its status.
     * @param Export $export
     * @return $this
     */
    public function setExport(Export $export): self
    {
        $this->export = $export;
        return $this;
    }

    /**
     * Returns the export with its status.
     * @return Export
     */
    public function getExport(): Export
    {
        return $this->export;
    }
}

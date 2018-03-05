<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Entity;

use BluePsyduck\Common\Data\DataContainer;

/**
 * The entity representing the meta data of the responses.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Meta implements EntityInterface
{
    /**
     * The status code of the response.
     * @var int
     */
    protected $statusCode = 0;

    /**
     * The execution time of the request on the server, in seconds.
     * @var float
     */
    protected $executionTime = 0.;

    /**
     * The error message in case one occurred.
     * @var string
     */
    protected $errorMessage = '';

    /**
     * Sets the status code of the response.
     * @param int $statusCode
     * @return $this Implementing fluent interface.
     */
    public function setStatusCode(int $statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * Returns the status code of the response.
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * Sets the execution time of the request on the server, in seconds.
     * @param float $executionTime
     * @return $this Implementing fluent interface.
     */
    public function setExecutionTime(float $executionTime)
    {
        $this->executionTime = $executionTime;
        return $this;
    }

    /**
     * Returns the execution time of the request on the server, in seconds.
     * @return float
     */
    public function getExecutionTime(): float
    {
        return $this->executionTime;
    }

    /**
     * Sets the error message in case one occurred.
     * @param string $errorMessage
     * @return $this Implementing fluent interface.
     */
    public function setErrorMessage(string $errorMessage)
    {
        $this->errorMessage = $errorMessage;
        return $this;
    }

    /**
     * Returns the error message in case one occurred.
     * @return string
     */
    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }

    /**
     * Writes the entity data to an array.
     * @return array
     */
    public function writeData(): array
    {
        return [
            'statusCode' => $this->statusCode,
            'executionTime' => $this->executionTime,
            'errorMessage' => $this->errorMessage,
        ];
    }

    /**
     * Reads the entity data.
     * @param DataContainer $data
     * @return $this
     */
    public function readData(DataContainer $data)
    {
        $this->statusCode = $data->getInteger('statusCode');
        $this->executionTime = $data->getFloat('executionTime');
        $this->errorMessage = $data->getString('errorMessage');
        return $this;
    }
}
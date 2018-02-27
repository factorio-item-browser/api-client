<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Entity;

/**
 * The entity representing the meta data of the responses.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Meta
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
     * The messages of the response.
     * @var array|Message[]
     */
    protected $messages = [];

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
     * Sets the messages of the response.
     * @param array|Message[] $messages
     * @return $this Implementing fluent interface.
     */
    public function setMessages(array $messages)
    {
        $this->messages = array_values(array_filter($messages, function ($message): bool {
            return $message instanceof Message;
        }));
        return $this;
    }

    /**
     * Adds a message to the meta entity.
     * @param Message $message
     * @return $this
     */
    public function addMessage(Message $message)
    {
        $this->messages[] = $message;
        return $this;
    }

    /**
     * Returns the messages of the response.
     * @return array|Message[]
     */
    public function getMessages(): array
    {
        return $this->messages;
    }
}
<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Entity;

/**
 * The class representing a message of the meta node.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Message
{
    /**
     * The type of the message, a level of the PSR-3 logger.
     * @var string
     */
    protected $type = '';

    /**
     * The actual message.
     * @var string
     */
    protected $message = '';

    /**
     * Sets the type of the message, a level of the PSR-3 logger.
     * @param string $type
     * @return $this Implementing fluent interface.
     */
    public function setType(string $type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Returns the type of the message, a level of the PSR-3 logger.
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Sets the actual message.
     * @param string $message
     * @return $this Implementing fluent interface.
     */
    public function setMessage(string $message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * Returns the actual message.
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }
}
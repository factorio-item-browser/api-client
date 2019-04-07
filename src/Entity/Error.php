<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Entity;

/**
 * The class representing an error in the response.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Error
{
    /**
     * The message of the error.
     * @var string
     */
    protected $message = '';

    /**
     * Sets the message of the error.
     * @param string $message
     * @return $this
     */
    public function setMessage(string $message): self
    {
        $this->message = $message;
        return $this;
    }

    /**
     * Returns the message of the error.
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }
}

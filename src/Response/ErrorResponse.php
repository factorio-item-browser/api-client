<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Response;

use FactorioItemBrowser\Api\Client\Entity\Error;

/**
 * The response in case of an error.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ErrorResponse implements ResponseInterface
{
    /**
     * The error of the response.
     * @var Error
     */
    protected $error;

    /**
     * Initializes the response.
     */
    public function __construct()
    {
        $this->error = new Error();
    }

    /**
     * Sets the error of the response.
     * @param Error $error
     * @return $this
     */
    public function setError(Error $error): self
    {
        $this->error = $error;
        return $this;
    }

    /**
     * Returns the error of the response.
     * @return Error
     */
    public function getError(): Error
    {
        return $this->error;
    }
}

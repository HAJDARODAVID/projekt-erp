<?php

namespace App\Services;

/**
 * BaseService
 * Provides common functionality for handling service responses, 
 * success flags, and error messages across all specific services.
 */
class BaseService
{
    /**
     * @var bool Flag indicating success or failure.
     */
    protected bool $success = false;

    /**
     * @var string The message associated with the outcome.
     */
    protected string $message = '';

    /**
     * @var array The data payload to be returned.
     */
    protected array $data = [];

    /**
     * Sets a custom error message.
     *
     * @param string $message
     * @return $this
     */
    protected function setErrorMessage(string $message): self
    {
        $this->success = false;
        $this->message = $message;
        return $this;
    }

    /**
     * Sets a custom success message and optionally the data payload.
     *
     * @param string $message
     * @param array $data
     * @return $this
     */
    protected function setSuccessMessage(string $message, array $data = []): self
    {
        $this->success = true;
        $this->message = $message;
        $this->data = $data;
        return $this;
    }

    /**
     * Sets the data payload.
     *
     * @param array $data
     * @return $this
     */
    protected function setData(array $data = []): self
    {
        $this->success = true;
        $this->data = $data;
        return $this;
    }

    /**
     * Gets the complete structured response array.
     * * @return array
     */
    public function getResponse(): array
    {
        return [
            'success' => $this->success,
            'message' => $this->message,
            'data' => $this->data,
        ];
    }
}

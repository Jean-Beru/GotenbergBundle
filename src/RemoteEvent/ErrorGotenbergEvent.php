<?php

namespace Sensiolabs\GotenbergBundle\RemoteEvent;

use Symfony\Component\RemoteEvent\RemoteEvent;

class ErrorGotenbergEvent extends RemoteEvent
{
    public const ERROR = 'error';

    /**
     * @param array{status: string, message: string} $payload
     */
    public function __construct(
        string $id,
        array $payload,
        private readonly string $status,
        private readonly string $message,
    )
    {
        parent::__construct(self::ERROR, $id, $payload);
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}
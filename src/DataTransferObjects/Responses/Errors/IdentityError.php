<?php

namespace App\DataTransferObjects\Responses\Errors;

class IdentityError
{
    public function __construct(
        public readonly string $error,
        public readonly string $errorDescription,
    ) { }

    public static function fromArray( array $data ): self
    {
        return new self(
            error: $data['error'],
            errorDescription: $data['error_description'],
        );
    }
}
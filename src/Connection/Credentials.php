<?php

namespace App\Connection;

final class Credentials
{
    public function __construct(
        public readonly string $clientId,
        public readonly string $clientSecret,
    ) {
        if (empty($clientId)) {
            throw new \InvalidArgumentException('Client ID is required');
        }
        if (empty($clientSecret)) {
            throw new \InvalidArgumentException('Client Secret is required');
        }
    }
}
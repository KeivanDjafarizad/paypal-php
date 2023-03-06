<?php

namespace App\DataTransferObjects\Responses\Authentication;

class AuthenticationSuccess
{
    public function __construct(
        public string $accessToken,
        public string $tokenType,
        public string $expiresIn,
        public string $scope,
        public string $nonce,
    ) { }

    public static function fromArray( array $data ): self
    {
        return new self(
            accessToken: $data['access_token'],
            tokenType: $data['token_type'],
            expiresIn: $data['expires_in'],
            scope: $data['scope'],
            nonce: $data['nonce'],
        );
    }
}
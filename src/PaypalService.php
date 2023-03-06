<?php

namespace App;

use App\Connection\Credentials;
use App\DataTransferObjects\Responses\Authentication\AuthenticationSuccess;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class PaypalService
{
    private string $accessToken;
    public function __construct(
        private readonly Credentials $credentials,
        private Client $client,
    ) {
        $this->client = new Client([
            'base_uri' => 'https://api-m.sandbox.paypal.com/',
        ]);
    }

    /**
     * @throws GuzzleException
     * @throws \Exception
     */
    public function getToken(  ): AuthenticationSuccess
    {
        $res = $this
            ->client
            ->request(
                'POST',
                'v1/oauth2/token',
                [
                    'headers' => [
                        'Content-Type' => 'application/x-www-form-urlencoded',
                    ],
                    'form_params' => [
                        'grant_type' => 'client_credentials',
                    ],
                    'auth' => [
                        $this->credentials->clientId,
                        $this->credentials->clientSecret,
                    ],
                ]
            );
        $response = $this->parseResponse($res->getBody()->getContents());
        if($res->getStatusCode() > 299) {
            throw new \Exception('Error getting token');
        }
        return AuthenticationSuccess::fromArray($response);
    }

    private function parseResponse( string $body ): array
    {
        return json_decode($body, true);
    }
}
<?php

namespace App;

use App\Connection\Credentials;
use GuzzleHttp\Client;

class PaypalService
{
    public function __construct(
        private readonly Credentials $credentials,
        private Client $client
    ) {
        $this->client = new Client([
            'base_uri' => 'https://api-m.sandbox.paypal.com/',
        ]);
    }

    public function getToken(  )
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
        var_dump($res);
    }
}
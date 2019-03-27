<?php

namespace App\Services;

use Nexmo\Client;
use Nexmo\Client\Credentials\Basic as Auth;

class Nexmo 
{
    protected $client;

    protected $apiKey;

    protected $apiSecret;

    public function __construct()
    {
        $this->apiKey = config('services.nexmo.api_key');

        $this->apiSecret = config('services.nexmo.secret_key');

        $this->client = $this->setUp();
    }

    public function setUp()
    {
          return new Client(new Auth($this->apiKey, $this->apiSecret));
    }

    public function notify($number, $message)
    {
        $this->client->message()->send([
            'to' => $number,
            'from' => 'Store',
            'text' => $message
        ]);

        return;
    }
}

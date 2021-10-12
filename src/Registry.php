<?php

namespace Jaunas\Mikrotag;

use Dotenv\Dotenv;

class Registry
{
    private string $apiKey;
    private string $secretKey;

    public function __construct(Dotenv $dotenv)
    {
        $params = $dotenv->load();
        $this->apiKey = $params['API_KEY'] ?: '';
        $this->secretKey = $params['SECRET_KEY'] ?: '';
    }

    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    public function getSecretKey(): string
    {
        return $this->secretKey;
    }
}

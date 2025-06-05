<?php

namespace RYReLawyer\Services;

use GuzzleHttp\Client;

class BlockchainLogger
{
    protected Client $client;
    protected string $endpoint;

    public function __construct(string $endpoint, ?Client $client = null)
    {
        $this->endpoint = $endpoint;
        $this->client = $client ?: new Client();
    }

    /**
     * Log the hash on the blockchain service.
     */
    public function logHash(string $hash): void
    {
        // This is a placeholder implementation. In a real app we would POST to a blockchain API.
        $payload = ['json' => ['hash' => $hash]];
        $this->client->post($this->endpoint, $payload);
    }
}

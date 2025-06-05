<?php

namespace App\Services\Efiling;

class BaseEfilingService
{
    protected string $baseUri;

    public function __construct(string $configKey)
    {
        $this->baseUri = config("efiling.$configKey.base_uri");
    }

    protected function mockPost(string $endpoint, array $payload): array
    {
        // This is a placeholder for real HTTP calls
        return [
            'url' => rtrim($this->baseUri, '/') . $endpoint,
            'payload' => $payload,
        ];
    }
}

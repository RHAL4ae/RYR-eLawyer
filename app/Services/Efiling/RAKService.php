<?php

namespace App\Services\Efiling;

class RAKService extends BaseEfilingService
{
    public function __construct()
    {
        parent::__construct('rak');
    }

    public function submitCase(array $payload): array
    {
        return $this->mockPost('/cases', $payload);
    }
}

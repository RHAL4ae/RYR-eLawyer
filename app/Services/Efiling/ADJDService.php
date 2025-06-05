<?php

namespace App\Services\Efiling;

class ADJDService extends BaseEfilingService
{
    public function __construct()
    {
        parent::__construct('adjd');
    }

    public function submitCase(array $payload): array
    {
        return $this->mockPost('/cases', $payload);
    }
}

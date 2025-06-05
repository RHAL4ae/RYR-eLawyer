<?php

namespace App\Services\Efiling;

class MOJService extends BaseEfilingService
{
    public function __construct()
    {
        parent::__construct('moj');
    }

    public function submitCase(array $payload): array
    {
        return $this->mockPost('/cases', $payload);
    }
}

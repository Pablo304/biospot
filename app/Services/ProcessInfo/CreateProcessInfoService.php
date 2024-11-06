<?php

namespace App\Services\ProcessInfo;

use App\Models\ProcessInfo;
use App\Services\ProcessInfo\Contracts\CreateProcessInfoServiceContract;

class CreateProcessInfoService implements Contracts\CreateProcessInfoServiceContract
{
    public function __construct(
        private readonly ProcessInfo $processInfo
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function execute(array $data): mixed
    {
        return $this->processInfo->create($data);
    }
}

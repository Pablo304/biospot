<?php

namespace App\Services\Plague;

use App\Models\Plague\Plague;
use App\Services\Plague\Contracts\CreatePlagueServiceContract;

class CreatePlagueService implements Contracts\CreatePlagueServiceContract
{

    public function __construct(
        private readonly Plague $plague
    )
    {
    }

    public function execute(array $data)
    {
        return $this->plague->create($data);
    }
}

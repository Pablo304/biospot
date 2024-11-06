<?php

namespace App\Services\Suspect\Contracts;

use Illuminate\Http\Request;

interface CreateSuspectServiceContract
{
    /**
     * @param array $data
     * @return mixed
     */
    public function execute(array $data): mixed;
}

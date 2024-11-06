<?php

namespace App\Services\Suspect\Contracts;

use App\Http\Requests\ConfirmSuspectRequest;

interface ConfirmSuspectServiceContract
{
    /**
     * @param int|string $suspectId
     * @param ConfirmSuspectRequest $request
     * @return mixed
     */
    public function execute(int|string $suspectId, ConfirmSuspectRequest $request): mixed;
}

<?php

namespace App\Services\Complaint\Contracts;

use App\Http\Requests\ConfirmComplaintRequest;

interface ConfirmComplaintServiceContract
{
    /**
     * @param int|string $compliantId
     * @param ConfirmComplaintRequest $request
     * @return mixed
     */
    public function execute(int|string $compliantId, ConfirmComplaintRequest $request): mixed;
}

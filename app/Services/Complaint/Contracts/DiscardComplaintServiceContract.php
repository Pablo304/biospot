<?php

namespace App\Services\Complaint\Contracts;

interface DiscardComplaintServiceContract
{
    /**
     * @param int|string $complaintId
     * @return mixed
     */
    public function execute(int|string $complaintId): mixed;
}

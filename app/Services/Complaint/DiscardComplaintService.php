<?php

namespace App\Services\Complaint;

use App\Models\Complaint;
use App\Services\Complaint\Contracts\DiscardComplaintServiceContract;
use App\StatusEnum;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DiscardComplaintService implements Contracts\DiscardComplaintServiceContract
{
    public function __construct(
        private readonly Complaint $complaint
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function execute(int|string $complaintId): mixed
    {
        if (!$compliantModel = $this->complaint->find($complaintId)) {
            throw new ModelNotFoundException(__('messages.errors.model_not_found'));
        }
        $compliantModel->update([
            'status_id' => StatusEnum::CANCELLED,
            'finished_at' => now()
        ]);
        return $compliantModel->fresh();
    }
}

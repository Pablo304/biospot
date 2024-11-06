<?php

namespace App\Services\Suspect;

use App\Models\Suspect\Suspect;
use App\StatusEnum;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DiscardSuspectService implements Contracts\DiscardSuspectServiceContract
{

    public function __construct(
        private readonly Suspect $suspect
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function execute(int|string $suspectId): mixed
    {
        if (!$compliantModel = $this->suspect->find($suspectId)) {
            throw new ModelNotFoundException(__('messages.errors.model_not_found'));
        }
        $compliantModel->update([
            'status_id' => StatusEnum::CANCELLED,
            'finished_at' => now()
        ]);
        return $compliantModel->fresh();
    }
}

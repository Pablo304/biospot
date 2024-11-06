<?php

namespace App\Services\Complaint;

use App\Models\Complaint;
use App\Services\Complaint\Contracts\ListComplaintsServiceContract;

class ListComplaintsService implements Contracts\ListComplaintsServiceContract
{
    public function __construct(
        private readonly Complaint $complaint
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function execute(): mixed
    {
        return $this->complaint
            ->whereHas('processInfo', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })
            ->orWhereHas('organizations', function ($query){
                $query->where('organization_id', auth()->user()->organization_id);
            })
            ->orderBy('id', 'desc')
            ->get();
    }
}

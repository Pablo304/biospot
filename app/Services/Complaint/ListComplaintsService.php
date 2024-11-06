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
            ->when(auth()->user(), function ($query) {
                $query->whereHas('processInfo', function ($query) {
                    $query->where('user_id', auth()->user()->id);
                });
            })
            ->get();
    }
}

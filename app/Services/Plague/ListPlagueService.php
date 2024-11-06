<?php

namespace App\Services\Plague;

use App\Models\Plague\Plague;
use App\Services\Plague\Contracts\ListPlagueServiceContract;

class ListPlagueService implements Contracts\ListPlagueServiceContract
{
    public function __construct(
        private readonly Plague $plague
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function execute(): mixed
    {
        return $this->plague
            ->whereHas('processInfo', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })
            ->orWhereHas('organizations', function ($query) {
                $query->where('organization_id', auth()->user()->organization_id);
            })
            ->orderBy('id', 'desc')
            ->get();
    }
}

<?php

namespace App\Services\Plague;

use App\Models\Plague\PlagueStatus;
use App\Services\Plague\Contracts\ListPlagueStatusServiceContract;
use Illuminate\Support\Facades\Cache;

class ListPlagueStatusService implements Contracts\ListPlagueStatusServiceContract
{
    public function __construct(
        private readonly PlagueStatus $plagueStatus
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function execute(): mixed
    {
        return Cache::remember('plague_status', now()->addMinutes(5), function () {
            return $this->plagueStatus->get();
        });
    }
}

<?php

namespace App\Services\Status;

use App\Models\Status;
use App\Services\Status\Contracts\ListStatusServiceContract;
use Illuminate\Support\Facades\Cache;

class ListStatusService implements Contracts\ListStatusServiceContract
{
    public function __construct(
        private readonly Status $status
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function execute(): mixed
    {
        return Cache::remember('status', now()->addMinutes(5), function () {
            return $this->status->get();
        });
    }
}

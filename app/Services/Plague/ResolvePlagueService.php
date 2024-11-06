<?php

namespace App\Services\Plague;

use App\Models\Plague\Plague;
use App\PlagueStatusEnum;
use App\Services\Plague\Contracts\ResolvePlagueServiceContract;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ResolvePlagueService implements Contracts\ResolvePlagueServiceContract
{
    public function __construct(
        private readonly Plague $plague
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function execute(int|string $plagueId): void
    {
        $plague = $this->plague->findOrFail($plagueId);
        $plague->update([
            'plague_status_id' => PlagueStatusEnum::RESOLVED,
        ]);
    }
}

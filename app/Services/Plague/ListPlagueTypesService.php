<?php

namespace App\Services\Plague;

use App\Models\Plague\PlagueType;
use App\Services\Plague\Contracts\ListPlagueTypesServiceContract;
use Illuminate\Support\Facades\Cache;

class ListPlagueTypesService implements Contracts\ListPlagueTypesServiceContract
{
    public function __construct(
        private readonly PlagueType $plagueType
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function execute(): mixed
    {
        return Cache::remember('plague-types', now()->addMinutes(5), function () {
            return $this->plagueType->all();
        });
    }
}

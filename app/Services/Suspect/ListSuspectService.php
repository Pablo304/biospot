<?php

namespace App\Services\Suspect;

use App\Models\Suspect\Suspect;
use App\Services\Complaint\Contracts;
use App\Services\Suspect\Contracts\ListSuspectServiceContract;

class ListSuspectService implements ListSuspectServiceContract
{
    public function __construct(
        private readonly Suspect $suspect
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function execute(): mixed
    {
        return $this->suspect
            ->orderBy('id', 'desc')
            ->get();
    }
}

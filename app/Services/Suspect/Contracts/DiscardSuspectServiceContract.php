<?php

namespace App\Services\Suspect\Contracts;

interface DiscardSuspectServiceContract
{
    /**
     * @param int|string $suspectId
     * @return mixed
     */
    public function execute(int|string $suspectId): mixed;
}

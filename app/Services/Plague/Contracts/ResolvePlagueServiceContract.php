<?php

namespace App\Services\Plague\Contracts;

interface ResolvePlagueServiceContract
{
    /**
     * @param int|string $plagueId
     * @return void
     */
    public function execute(int|string $plagueId): void;
}

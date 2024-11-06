<?php

namespace App\Services\ProcessInfo\Contracts;

interface CreateProcessInfoServiceContract
{
    /**
     * @param array $data
     * @return mixed
     */
    public function execute(array $data): mixed;
}

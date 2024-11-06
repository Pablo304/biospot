<?php

namespace App\Services\Complaint\Contracts;

interface StoreCompliantServiceContract
{
    /**
     * @param array $data
     * @return mixed
     */
    public function execute(array $data): mixed;
}

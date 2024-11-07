<?php

namespace App\Services\Complaint\Contracts;

interface StoreCompliantServiceContract
{
    /**
     * @param array $data
     * @param int|null $user_id
     * @return mixed
     */
    public function execute(array $data, ?int $user_id = null): mixed;
}

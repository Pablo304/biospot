<?php

namespace App\Services\Address\Contracts;

interface CreateAddressServiceContract
{
    /**
     * @param array $data
     * @return mixed
     */
    public function execute(array $data): mixed;
}

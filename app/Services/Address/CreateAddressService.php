<?php

namespace App\Services\Address;

use App\Models\Address\Address;
use App\Services\Address\Contracts\CreateAddressServiceContract;

class CreateAddressService implements Contracts\CreateAddressServiceContract
{
    public function __construct(
        private readonly Address $address
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function execute(array $data): mixed
    {
        return $this->address->create($data);
    }
}

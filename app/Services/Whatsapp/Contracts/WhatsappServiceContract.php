<?php

namespace App\Services\Whatsapp\Contracts;

interface WhatsappServiceContract
{
    /**
     * @param array $data
     * @return mixed
     */
    public function execute(array $data): mixed;
}

<?php

namespace App\Services\Complaint;

use App\Services\Complaint\Contracts\StoreComplaintServiceContract;

class StoreComplaintService implements Contracts\StoreComplaintServiceContract
{

    public function execute($request)
    {
        dd('entrei');
    }
}

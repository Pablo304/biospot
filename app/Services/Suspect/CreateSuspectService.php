<?php

namespace App\Services\Suspect;

use App\Models\Suspect\Suspect;
use App\Services\Suspect\Contracts\CreateSuspectServiceContract;
use Illuminate\Http\Request;

class CreateSuspectService implements Contracts\CreateSuspectServiceContract
{
    public function __construct(
        private readonly Suspect $suspect
    )
    {
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function execute(array $data): mixed
    {
        return $this->suspect->create($data);
    }
}

<?php

namespace App\Services\OrganizationPlague;

use App\Models\Plague\OrganizationPlague;
use App\Services\OrganizationPlague\Contract\CreateOrganizationPlagueServiceContract;

class CreateOrganizationPlagueService implements Contract\CreateOrganizationPlagueServiceContract
{

    public function __construct(
        private readonly OrganizationPlague                     $organizationPlague,
    )
    {
    }

    public function execute(array $data)
    {
        $this->organizationPlague->create($data);
    }
}

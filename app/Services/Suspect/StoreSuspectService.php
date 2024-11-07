<?php

namespace App\Services\Suspect;

use App\Models\Complaint;
use App\Models\ComplaintOrganization;
use App\Models\OrganizationSuspect;
use App\Models\ProcessInfo;
use App\OrganizationEnum;
use App\RelationTypeEnum;
use App\Services\Address\Contracts\CreateAddressServiceContract;
use App\Services\OrganizationPlague\Contract\CreateOrganizationPlagueServiceContract;
use App\Services\Suspect\Contracts\CreateSuspectServiceContract;
use App\Services\Suspect\Contracts\StoreSuspectServiceContract;
use App\StatusEnum;
use Illuminate\Support\Facades\DB;

class StoreSuspectService implements StoreSuspectServiceContract
{

    public function __construct(
        private readonly ProcessInfo                  $processInfo,
        private readonly CreateAddressServiceContract $createAddressService,
        private readonly CreateSuspectServiceContract $createSuspectService,
        private readonly OrganizationSuspect $organizationSuspect
    )
    {
    }

    public function execute($request)
    {
        $addressData = $request['address'];
        try {

            DB::beginTransaction();
            $address = $this->createAddressService->execute($addressData);
            $processInfo = $this->processInfo->create([
                'description' => $request['description'],
                'user_id' => auth()->user()->id,
                'address_id' => $address->id
            ]);

            $suspect = $this->createSuspectService->execute([
                'status_id' => StatusEnum::IN_PROGRESS,
                'process_info_id' => $processInfo->id,
                'notes' => $request['description']
            ]);

            $this->organizationSuspect->create([
               'suspect_id' => $suspect->id,
               'organization_id' => OrganizationEnum::ADERR,
               'relation_type' => 'observer'
            ]);

            $this->organizationSuspect->create([
                'suspect_id' => $suspect->id,
                'organization_id' => OrganizationEnum::EMBRAPA,
                'relation_type' => 'executor'
            ]);

            DB::commit();
            return $suspect->fresh();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }
}

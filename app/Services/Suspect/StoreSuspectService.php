<?php

namespace App\Services\Suspect;

use App\Models\Complaint;
use App\Models\ComplaintOrganization;
use App\Models\ProcessInfo;
use App\OrganizationEnum;
use App\Services\Address\Contracts\CreateAddressServiceContract;
use App\Services\Suspect\Contracts\CreateSuspectServiceContract;
use App\Services\Suspect\Contracts\StoreSuspectServiceContract;
use App\StatusEnum;
use Illuminate\Support\Facades\DB;

class StoreSuspectService implements StoreSuspectServiceContract
{

    public function __construct(
        private readonly ProcessInfo                  $processInfo,
        private readonly CreateAddressServiceContract $createAddressService,
        private readonly CreateSuspectServiceContract $createSuspectService
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

            DB::commit();
            return $suspect->fresh();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }
}

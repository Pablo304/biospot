<?php

namespace App\Services\Complaint;

use App\Models\Complaint;
use App\Models\ComplaintOrganization;
use App\Models\ProcessInfo;
use App\OrganizationEnum;
use App\Services\Address\Contracts\CreateAddressServiceContract;
use App\Services\Complaint\Contracts\StoreCompliantServiceContract;
use App\StatusEnum;
use Illuminate\Support\Facades\DB;

class StoreCompliantService implements Contracts\StoreCompliantServiceContract
{
    public function __construct(
        private readonly ProcessInfo                  $processInfo,
        private readonly CreateAddressServiceContract $createAddressService,
        private readonly Complaint                    $complaint
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function execute(array $data, ?int $user_id = null): mixed
    {
        $addressData = $data['address'];
        try {

            DB::beginTransaction();
            $address = $this->createAddressService->execute($addressData);
            $processInfo = $this->processInfo->create([
                'description' => $data['description'],
                'user_id' => auth()->user()->id ?? $user_id,
                'address_id' => $address->id
            ]);

            $complaint = $this->complaint->create([
                'started_at' => now(),
                'finished_at' => null,
                'process_info_id' => $processInfo->id,
                'status_id' => StatusEnum::IN_PROGRESS,
            ]);

            ComplaintOrganization::create([
                'complaint_id' => $complaint->id,
                'organization_id' => OrganizationEnum::ADERR,
                'relation_type' => 'executor'
            ]);
            DB::commit();
            return $complaint->fresh();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }
}

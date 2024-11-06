<?php

namespace App\Services\Complaint;

use App\Http\Requests\ConfirmComplaintRequest;
use App\Models\Complaint;
use App\Services\Complaint\Contracts\ConfirmComplaintServiceContract;
use App\Services\Suspect\Contracts\CreateSuspectServiceContract;
use App\StatusEnum;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class ConfirmComplaintService implements Contracts\ConfirmComplaintServiceContract
{
    public function __construct(
        private readonly Complaint                    $compliant,
        private readonly CreateSuspectServiceContract $createSuspectService
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function execute(int|string $compliantId, ConfirmComplaintRequest $request): mixed
    {
        try {
            DB::beginTransaction();
            $compliant = $this->compliant->findOrFail($compliantId);
            $compliant->update([
                'status_id' => StatusEnum::CONFIRMED,
                'finished_at' => now()
            ]);

            $compliant = $compliant->fresh();

            $suspect = $this->createSuspectService->execute([
                'complaint_id' => $compliant->id,
                'status_id' => StatusEnum::IN_PROGRESS,
                'process_info_id' => $compliant->processInfo->id,
                'notes' => $request->validated()['notes']
            ]);


            DB::commit();
            return $suspect;
        } catch (ModelNotFoundException $exception) {
            DB::rollBack();
            throw new ModelNotFoundException(__('messages.errors.model_not_found'));
        } catch (\Exception $exception) {
            DB::rollBack();
            dd($exception->getMessage());
            throw $exception;
        }
    }
}

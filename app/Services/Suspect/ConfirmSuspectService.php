<?php

namespace App\Services\Suspect;

use App\Http\Requests\ConfirmSuspectRequest;
use App\Models\Suspect\Suspect;
use App\PlagueStatusEnum;
use App\Services\Plague\Contracts\CreatePlagueServiceContract;
use App\StatusEnum;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class ConfirmSuspectService implements Contracts\ConfirmSuspectServiceContract
{

    public function __construct(
        private readonly Suspect                     $suspect,
        private readonly CreatePlagueServiceContract $createPlagueService
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function execute(int|string $suspectId, ConfirmSuspectRequest $request): mixed
    {
        try {
            DB::beginTransaction();
            $suspect = $this->suspect->findOrFail($suspectId);
            $suspect->update([
                'status_id' => StatusEnum::CONFIRMED,
                'finished_at' => now()
            ]);

            $suspect = $suspect->fresh();

            $suspect = $this->createPlagueService->execute([
                'plague_type_id' => $request->plague_type_id,
                'suspect_id' => $suspect->id,
                'process_info_id' => $suspect->processInfo->id,
                'plague_status_id' => PlagueStatusEnum::ACTIVE,
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

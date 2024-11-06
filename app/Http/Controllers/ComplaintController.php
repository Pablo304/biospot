<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComplaintRequest;
use App\Http\Resources\ComplaintResource;
use App\Models\Complaint;
use App\Services\Complaint\Contracts\DiscardComplaintServiceContract;
use App\Services\Complaint\Contracts\ListComplaintsServiceContract;
use App\Services\Complaint\Contracts\StoreComplaintServiceContract;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ComplaintController extends Controller
{
    public function index(ListComplaintsServiceContract $listComplaintsService)
    {
        try {
            return ComplaintResource::collection($listComplaintsService->execute());
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

    public function show(Complaint $compliant)
    {
        ;
        return new ComplaintResource($compliant);
    }

    public function discard(int|string $compliantId, DiscardComplaintServiceContract $discardComplaintService)
    {
        try {
            $discardComplaintService->execute($compliantId);
            return true;
        } catch (ModelNotFoundException $exception) {
            Log::error($exception->getMessage());
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }


    /**
     * @param StoreComplaintRequest $request
     * @param StoreComplaintServiceContract $storeComplaintService
     * @return ComplaintResource|string
     */
    public function store(StoreComplaintRequest $request, StoreComplaintServiceContract $storeComplaintService): string|ComplaintResource
    {
        try {
            dd('entrei');
        } catch (ModelNotFoundException $exception) {
            return $exception->getMessage();
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}

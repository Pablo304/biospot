<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConfirmComplaintRequest;
use App\Http\Resources\ComplaintResource;
use App\Models\Complaint;
use App\Services\Complaint\Contracts\ConfirmComplaintServiceContract;
use App\Services\Complaint\Contracts\DiscardComplaintServiceContract;
use App\Services\Complaint\Contracts\ListComplaintsServiceContract;
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

    public function confirm(int|string $compliantId, ConfirmComplaintRequest $request, ConfirmComplaintServiceContract $confirmComplaintService)
    {
        try {
            return $confirmComplaintService->execute($compliantId, $request);
        } catch (ModelNotFoundException $exception) {
            Log::error($exception->getMessage());
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }
}

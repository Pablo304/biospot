<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConfirmComplaintRequest;
use App\Http\Requests\CreateCompliantRequest;
use App\Http\Resources\ComplaintResource;
use App\Models\Complaint;
use App\Services\Complaint\Contracts\ConfirmComplaintServiceContract;
use App\Services\Complaint\Contracts\DiscardComplaintServiceContract;
use App\Services\Complaint\Contracts\ListComplaintsServiceContract;
use App\Services\Complaint\Contracts\StoreCompliantServiceContract;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class ComplaintController extends Controller
{
    public function index(ListComplaintsServiceContract $listComplaintsService)
    {
        try {
            return ComplaintResource::collection($listComplaintsService->execute());
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json([
                'message' => $exception->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(Complaint $compliant)
    {
        return new ComplaintResource($compliant);
    }

    public function store(CreateCompliantRequest $request, StoreCompliantServiceContract $storeCompliantService)
    {
        try {
            return new ComplaintResource($storeCompliantService->execute($request->validated()));
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json([
                'message' => $exception->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function discard(int|string $compliantId, DiscardComplaintServiceContract $discardComplaintService)
    {
        try {
            $discardComplaintService->execute($compliantId);
            return true;
        } catch (ModelNotFoundException $exception) {
            Log::error($exception->getMessage());
            return response()->json([
                'message' => $exception->getMessage()
            ], Response::HTTP_NOT_FOUND);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json([
                'message' => $exception->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function confirm(int|string $compliantId, ConfirmComplaintRequest $request, ConfirmComplaintServiceContract $confirmComplaintService)
    {
        try {
            return $confirmComplaintService->execute($compliantId, $request);
        } catch (ModelNotFoundException $exception) {
            Log::error($exception->getMessage());
            return response()->json([
                'message' => $exception->getMessage()
            ], Response::HTTP_NOT_FOUND);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json([
                'message' => $exception->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}

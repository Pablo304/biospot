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
use Exception;
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
            return self::successResponse(
                data: new ComplaintResource($storeCompliantService->execute($request->validated())),
                message: ('Denúncia registrada com sucesso.')
            );
        } catch (Exception $exception) {
            return self::returnError($exception);
        }
    }

    public function discard(int|string $compliantId, DiscardComplaintServiceContract $discardComplaintService)
    {
        try {
            return self::successResponse(
                data: $discardComplaintService->execute($compliantId),
                message: ('Denúncia descartada com sucesso.')
            );
        } catch (Exception $exception) {
            return self::returnError($exception);
        }
    }

    public function confirm(int|string $compliantId, ConfirmComplaintRequest $request, ConfirmComplaintServiceContract $confirmComplaintService)
    {
        try {
            return self::successResponse(
                data: $confirmComplaintService->execute($compliantId, $request),
                message: ('Denúncia confirmada com sucesso.')
            );
        } catch (Exception $exception) {
            return self::returnError($exception);
        }
    }
}

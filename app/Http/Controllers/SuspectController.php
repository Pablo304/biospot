<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConfirmSuspectRequest;
use App\Http\Requests\CreatePlagueRequest;
use App\Http\Resources\SuspectResource;
use App\Models\Suspect\Suspect;
use App\Services\Plague\Contracts\CreatePlagueServiceContract;
use App\Services\Suspect\Contracts\ConfirmSuspectServiceContract;
use App\Services\Suspect\Contracts\DiscardSuspectServiceContract;
use App\Services\Suspect\Contracts\ListSuspectServiceContract;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class SuspectController extends Controller
{
    public function index(ListSuspectServiceContract $listSuspectService)
    {
        try {
            return SuspectResource::collection($listSuspectService->execute());
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json([
                'message' => $exception->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(CreatePlagueRequest $request, CreatePlagueServiceContract $createPlagueService)
    {
        try {
            return $createPlagueService->execute($request->validated());
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(Suspect $suspect)
    {
        ;
        return new SuspectResource($suspect);
    }

    public function discard(int|string $suspectId, DiscardSuspectServiceContract $discardSuspectService)
    {
        try {
            $discardSuspectService->execute($suspectId);
            return true;
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], Response::HTTP_NOT_FOUND);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function confirm(int|string $suspectId, ConfirmSuspectRequest $request, ConfirmSuspectServiceContract $confirmSuspectService)
    {
        try {
            return $confirmSuspectService->execute($suspectId, $request);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], Response::HTTP_NOT_FOUND);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}

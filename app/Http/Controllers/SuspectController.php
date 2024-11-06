<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConfirmSuspectRequest;
use App\Http\Requests\CreateSuspectRequest;
use App\Http\Requests\CreatePlagueRequest;
use App\Http\Resources\SuspectResource;
use App\Models\Suspect\Suspect;
use App\Services\Plague\Contracts\CreatePlagueServiceContract;
use App\Services\Suspect\Contracts\ConfirmSuspectServiceContract;
use App\Services\Suspect\Contracts\CreateSuspectServiceContract;
use App\Services\Suspect\Contracts\DiscardSuspectServiceContract;
use App\Services\Suspect\Contracts\ListSuspectServiceContract;
use App\Services\Suspect\Contracts\StoreSuspectServiceContract;
use Exception;
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


    public function store(CreateSuspectRequest $request, StoreSuspectServiceContract $storeSuspectService)
    {
        try {
            return self::successResponse(
                data: new SuspectResource($storeSuspectService->execute($request->validated())),
                message: ('Suspeita registrada com sucesso.')
            );
        } catch (Exception $exception) {
            return self::returnError($exception);
        }
    }

    public function discard(int|string $suspectId, DiscardSuspectServiceContract $discardSuspectService)
    {
        try {
            return self::successResponse(
                data:$discardSuspectService->execute($suspectId),
                message: ('Suspeita descartada com sucesso.')
            );
        } catch (Exception $exception) {
            return self::returnError($exception);
        }
    }

    public function confirm(int|string $suspectId, ConfirmSuspectRequest $request, ConfirmSuspectServiceContract $confirmSuspectService)
    {
        try {
            return self::successResponse(
                data: $confirmSuspectService->execute($suspectId, $request),
                message: ('Suspeita confirmada com sucesso.')
            );
        } catch (Exception $exception) {
            return self::returnError($exception);
        }
    }
}

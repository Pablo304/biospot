<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConfirmSuspectRequest;
use App\Http\Resources\SuspectResource;
use App\Models\Suspect\Suspect;
use App\Services\Suspect\Contracts\ConfirmSuspectServiceContract;
use App\Services\Suspect\Contracts\DiscardSuspectServiceContract;
use App\Services\Suspect\Contracts\ListSuspectServiceContract;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class SuspectController extends Controller
{
    public function index(ListSuspectServiceContract $listSuspectService)
    {
        try {
            return SuspectResource::collection($listSuspectService->execute());
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
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

<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConfirmSuspectRequest;
use App\Http\Resources\SuspectResource;
use App\Models\Suspect\Suspect;
use App\Services\Suspect\Contracts\ConfirmSuspectServiceContract;
use App\Services\Suspect\Contracts\DiscardSuspectServiceContract;
use App\Services\Suspect\Contracts\ListSuspectServiceContract;
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
            $discardSuspectService->execute($suspectId);
            return true;
        } catch (ModelNotFoundException $exception) {
            Log::error($exception->getMessage());
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

    public function confirm(int|string $suspectId, ConfirmSuspectRequest $request, ConfirmSuspectServiceContract $confirmSuspectService)
    {
        try {
            return $confirmSuspectService->execute($suspectId, $request);
        } catch (ModelNotFoundException $exception) {
            Log::error($exception->getMessage());
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }
}

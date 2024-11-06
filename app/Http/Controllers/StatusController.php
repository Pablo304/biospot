<?php

namespace App\Http\Controllers;

use App\Http\Resources\StatusResource;
use App\Services\Status\Contracts\ListStatusServiceContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StatusController extends Controller
{
    public function index(ListStatusServiceContract $listStatusService)
    {
        try {
            return StatusResource::collection($listStatusService->execute());
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }
}

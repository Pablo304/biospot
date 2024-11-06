<?php

namespace App\Http\Controllers;

use App\Http\Resources\ComplaintResource;
use App\Services\Complaint\Contracts\ListComplaintsServiceContract;
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
}

<?php

namespace App\Http\Controllers;

use App\Http\Resources\ComplaintResource;
use App\Services\Complaint\Contracts\ListComplaintsServiceContract;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function index(ListComplaintsServiceContract $listComplaintsService)
    {
        return ComplaintResource::collection($listComplaintsService->execute());
    }
}

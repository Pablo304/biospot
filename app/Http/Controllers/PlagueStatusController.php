<?php

namespace App\Http\Controllers;

use App\Http\Resources\PlagueStatusResource;
use App\Services\Plague\Contracts\ListPlagueStatusServiceContract;

class PlagueStatusController extends Controller
{

    public function index(ListPlagueStatusServiceContract $listPlagueStatusService): mixed
    {
        try {
            return PlagueStatusResource::collection($listPlagueStatusService->execute());
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}

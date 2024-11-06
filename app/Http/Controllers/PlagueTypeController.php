<?php

namespace App\Http\Controllers;

use App\Http\Resources\PlagueTypeResource;
use App\Services\Plague\Contracts\ListPlagueTypesServiceContract;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PlagueTypeController extends Controller
{
    public function index(ListPlagueTypesServiceContract $listPlagueTypesService): mixed
    {
        try {
            return PlagueTypeResource::collection($listPlagueTypesService->execute());
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
                'code' => $exception->getCode()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}

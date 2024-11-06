<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePlagueRequest;
use App\Http\Resources\PlagueResource;
use App\Models\Plague\OrganizationPlague;
use App\OrganizationEnum;
use App\PlagueStatusEnum;
use App\Services\Address\Contracts\CreateAddressServiceContract;
use App\Services\Plague\Contracts\CreatePlagueServiceContract;
use App\Services\ProcessInfo\Contracts\CreateProcessInfoServiceContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class PlagueController extends Controller
{
    public function store(CreatePlagueRequest              $request,
                          CreatePlagueServiceContract      $createPlagueService,
                          CreateProcessInfoServiceContract $createProcessInfoService,
                          CreateAddressServiceContract     $createAddressService)
    {
        try {
            DB::beginTransaction();
            $addressData = $request->validated()['address'];
            $address = $createAddressService->execute($addressData);
            $processInfo = $createProcessInfoService->execute([
                'address_id' => $address->id,
                'user_id' => auth()->user()->id,
                'description' => $request->validated()['description']
            ]);
            $plague = $createPlagueService->execute([
                'plague_type_id' => $request->validated()['plague_type_id'],
                'process_info_id' => $processInfo->id,
                'plague_status_id' => PlagueStatusEnum::ACTIVE,
            ]);


            OrganizationPlague::create([
                'plague_id' => $plague->id,
                'organization_id' => OrganizationEnum::ADERR,
                'relation_type' => 'executor'
            ]);
            DB::commit();
            return new PlagueResource($plague->fresh());
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json([
                'message' => $exception->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
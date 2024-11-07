<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePlagueRequest;
use App\Http\Resources\PlagueResource;
use App\Models\Plague\OrganizationPlague;
use App\Models\Plague\Plague;
use App\OrganizationEnum;
use App\PlagueStatusEnum;
use App\Services\Address\Contracts\CreateAddressServiceContract;
use App\Services\Plague\Contracts\CreatePlagueServiceContract;
use App\Services\Plague\Contracts\ListPlagueServiceContract;
use App\Services\Plague\Contracts\ResolvePlagueServiceContract;
use App\Services\ProcessInfo\Contracts\CreateProcessInfoServiceContract;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class PlagueController extends Controller
{
    public function index(ListPlagueServiceContract $listPlagueService): JsonResponse
    {
        try {
            return self::successResponse(
                data: PlagueResource::collection($listPlagueService->execute()),
                message: ('Pragas encontradas com sucesso.')
            );
        } catch (\Exception $exception) {
            return self::internalServerErrorResponse($exception);
        }
    }

    public function show(Plague $plague)
    {
        try {
            return self::successResponse(
                data: new PlagueResource($plague),
                message: 'Pragas encontradas com sucesso.'
            );
        } catch (\Exception $exception) {
            return self::internalServerErrorResponse($exception);
        }
    }

    public function store(CreatePlagueRequest              $request,
                          CreatePlagueServiceContract      $createPlagueService,
                          CreateProcessInfoServiceContract $createProcessInfoService,
                          CreateAddressServiceContract     $createAddressService): JsonResponse
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
                'organization_id' => OrganizationEnum::EMBRAPA,
                'relation_type' => 'executor'
            ]);
            DB::commit();
            return self::successResponse(
                data: new PlagueResource($plague->fresh()),
                message: ('Praga registrada com sucesso.')
            );
        } catch (\Exception $exception) {
            DB::rollBack();
            return self::internalServerErrorResponse($exception);
        }
    }

    public function resolve(int|string $plagueId, ResolvePlagueServiceContract $resolvePlagueService): JsonResponse
    {
        try {
            $resolvePlagueService->execute($plagueId);
            return self::successResponse(
                data: [],
                message: 'Praga resolvida com sucesso.'
            );
        } catch (ModelNotFoundException $exception) {
            return self::modelNotFoundResponse($exception);
        } catch (\Exception $exception) {
            return self::internalServerErrorResponse($exception);
        }
    }
}

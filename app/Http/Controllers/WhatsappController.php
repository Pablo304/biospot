<?php

namespace App\Http\Controllers;

use App\Http\Requests\WhatsappRequest;
use App\Services\Whatsapp\Contracts\WhatsappServiceContract;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WhatsappController extends Controller
{

    /**
     * @param WhatsappRequest $request
     * @param WhatsappServiceContract $whatsappService
     * @return JsonResponse
     */
    public function receive(WhatsappRequest $request, WhatsappServiceContract $whatsappService): JsonResponse
    {
        try {
            return response()->json([
                'success' => true,
                'data' => $whatsappService->execute($request->validated())
            ]);
        } catch (\Exception $exception) {
            return self::internalServerErrorResponse(
                $exception,
                __('messages.whatsapp.error')
            );
        }
    }
}

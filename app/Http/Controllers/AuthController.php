<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\LoginResource;
use App\Services\Auth\Contract\LoginServiceContract;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;


class AuthController extends Controller
{


    public function login(LoginRequest $request, LoginServiceContract $loginService)
    {
        try {
            return new LoginResource($loginService->execute($request));

        } catch (UnauthorizedHttpException $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], Response::HTTP_UNAUTHORIZED);
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }
}

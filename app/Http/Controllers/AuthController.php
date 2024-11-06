<?php

namespace App\Http\Controllers;

use App\Http\Resources\LoginResource;
use App\Services\Auth\Contract\LoginServiceContract;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;


class AuthController extends Controller
{

    private LoginServiceContract $loginService;

    public function __construct()
    {
        $this->services();
    }

    public function services(): void
    {
        $this->loginService = app(LoginServiceContract::class);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|string
     */
    public function login(Request $request)
    {
        try {
            return $this->loginService->execute($request);
        } catch (UnauthorizedHttpException $exception) {
            return $exception->getMessage();
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }
}

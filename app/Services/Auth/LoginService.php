<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Services\Auth\Contract\LoginServiceContract;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class LoginService implements Contract\LoginServiceContract
{
    public function execute($request)
    {

        $user = User::where('email', $request->input('email'))->first();

        if (!$user || !Hash::check($request['password'], $user->password)) {
            throw new UnauthorizedHttpException('', 'Usuário ou senha inválidos.');
        }
        $accessToken = $user->createToken(
            name: 'user_token',
            abilities: []
        );
        return [
            'name' => $user->name,
            'access_token' => $accessToken->plainTextToken,
            'abilities' => $accessToken->accessToken->abilities
        ];

    }
}

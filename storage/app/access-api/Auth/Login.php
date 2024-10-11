<?php declare(strict_types=1);

namespace App\GraphQL\Auth;

use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

final readonly class Login
{
    /** @param  array{}  $args */
    public function __invoke(null $_, array $args)
    {
        $credentials = ['email' => $args['email'], 'password' => $args['password']];

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                throw ValidationException::withMessages([
                    'login' => 'Credenciais de login inválidas'
                ]);
            }
        } catch (JWTException $e) {
            throw ValidationException::withMessages([
                'login' => 'Não foi possível criar o token'
            ]);
        }

        $user = JWTAuth::user();
        $user->token = $token;
        return $user;
    }
}

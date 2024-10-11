<?php declare(strict_types=1);

namespace App\GraphQL\Auth;

use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

final readonly class RefreshTokenJwt
{
    /** @param  array{}  $args */
    public function __invoke(null $_, array $args)
    {
        try {
            $token = JWTAuth::refresh(false, true);
        } catch (JWTException $e) {
            throw ValidationException::withMessages([
                'authentication' => 'Erro ao renovar o token'
            ]);
        }

        $user = JWTAuth::user();
        $user->token = $token;
        return $user;
    }
}

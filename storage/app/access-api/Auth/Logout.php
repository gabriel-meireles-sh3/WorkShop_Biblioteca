<?php declare(strict_types=1);

namespace App\GraphQL\Auth;

use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

final readonly class Logout
{
    /** @param  array{}  $args */
    public function __invoke(null $_, array $args)
    {
        try {
            JWTAuth::invalidate();
        } catch (JWTException $e) {
            return ValidationException::withMessages([
                'authentication' => 'Erro ao deslogar'
            ]);
        }

        return true;
    }
}

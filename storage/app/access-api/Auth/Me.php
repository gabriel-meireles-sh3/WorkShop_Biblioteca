<?php declare(strict_types=1);

namespace App\GraphQL\Auth;

use Tymon\JWTAuth\Facades\JWTAuth;

final readonly class Me
{
    /** @param  array{}  $args */
    public function __invoke(null $_, array $args)
    {
        return JWTAuth::user();
    }
}

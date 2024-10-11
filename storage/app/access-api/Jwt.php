<?php

namespace App\GraphQL\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class Jwt
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            if (in_array($request['operationName'], ['IntrospectionQuery', 'Register', 'Login'])) {
                return $next($request);
            }

            JWTAuth::parseToken()->authenticate();
        } catch (JWTException $e) {
            $message = $e->getMessage();
            if ($message === 'The token has been blacklisted') {
                $message = 'Token inválido';
            }
            throw ValidationException::withMessages(['authentication' => $message]);
        }

        return $next($request);
    }
}

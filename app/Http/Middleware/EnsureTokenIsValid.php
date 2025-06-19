<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class EnsureTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get token from Authorization header
        $token = $request->bearerToken();

        // If token is missing, return unauthorized response
        if (!$token) {
            return response()->json(['message' => 'Token not provided'], 401);
        }

        try {
            // Decode the token using the secret key
            $decoded = JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));

            // Check if the token is expired
            if ($decoded->exp < time()) {
                return response()->json(['message' => 'Token expired'], 401);
            }

            // Add decoded token to request attributes
            $request->attributes->add(['user' => $decoded]);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Token is invalid'], 401);
        }

        return $next($request);
    }
}

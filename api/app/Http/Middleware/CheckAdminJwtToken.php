<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\JsonResponse;

class CheckAdminJwtToken
{

    public function handle(Request $request, Closure $next)
    {
        try {
            if (!JWTAuth::parseToken()) {
                $data = ['error_code' => ERROR_CODE['TOKEN_INVALID'], 'message' => __('lang.api.token_invalid')];
                $response = ['status' => "NG", 'error' => true, 'data' => $data];
                return new JsonResponse($response, HTTP_STATUS_UNAUTHORIZED);
            }

            $user = auth('admin')->user();

            if (!$user || $user->status !== ACTIVE) {
                $data = ['error_code' => ERROR_CODE['UNAUTHORIZED'], 'message' => __('lang.api.unauthorized')];
                $response = ['status' => "NG", 'error' => true, 'data' => $data];
                return new JsonResponse($response, HTTP_STATUS_UNAUTHORIZED);
            }
        } catch (JWTException $e) {
            if ($e instanceof TokenExpiredException) {
                $data = ['error_code' => ERROR_CODE['TOKEN_EXPIRED'], 'message' => __('lang.api.token_expired')];
            } else if ($e instanceof TokenInvalidException) {
                $data = ['error_code' => ERROR_CODE['TOKEN_INVALID'], 'message' => __('lang.api.token_invalid')];
            } else {
                $data = ['error_code' => ERROR_CODE['TOKEN_REQUIRE'], 'message' => __('lang.api.token_require')];
            }
            $response = ['status' => "NG", 'error' => true, 'data' => $data];
            return new JsonResponse($response, HTTP_STATUS_UNAUTHORIZED);
        }

        return $next($request);
    }
}

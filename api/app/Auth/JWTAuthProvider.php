<?php

namespace App\Auth;

use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Providers\Auth\Illuminate;

class JWTAuthProvider extends Illuminate
{

    /**
     * Check a user's credentials.
     *
     * @param  array  $credentials
     *
     * @return bool
     */
    public function byCredentials(array $credentials)
    {
        $module = JWTAuth::parseToken()->getClaim('module');
        return auth($module)->once($credentials);
    }

    /**
     * Authenticate a user via the id.
     *
     * @param  mixed  $id
     *
     * @return bool
     */
    public function byId($id)
    {
        $module = JWTAuth::parseToken()->getClaim('module');
        return auth($module)->onceUsingId($id);
    }

    /**
     * Get the authenticated user.
     *
     * @return \Tymon\JWTAuth\Contracts\JWTSubject
     */
    public function user()
    {
        $module = JWTAuth::parseToken()->getClaim('module');
        return auth($module)->user();
    }
}

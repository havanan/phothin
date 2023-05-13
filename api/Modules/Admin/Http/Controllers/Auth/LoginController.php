<?php

namespace Modules\Admin\Http\Controllers\Auth;

use App\Base\Controller\BaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Modules\Admin\Http\Requests\Admin\LoginRequest;
use Modules\Admin\Services\AdminService;

class LoginController extends BaseController
{
    /**
     * @var AdminService $textbookService
     */
    private $adminService;
    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    /**
     * Get a JWT via given credentials.
     *
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->only(['email', 'password']);
        try {
            $token = auth('admin')->attempt($credentials);
            if ($token) {
                Log::info('admin login with email: ' . $credentials['email']);
                return $this->adminService->responseWithToken($token);
            }
            return $this->statusNG(['error_code' => ERROR_CODE['PASSWORD_INCORRECT']], __('lang.api.password_incorrect'));
        } catch (\Exception $ex) {
            return $this->statusNG(['error_code' => ERROR_CODE['UNAUTHORIZED']], __('lang.api.unauthorized'));
        }
    }
    /**
     * Log the user out (Invalidate the token).
     *
     * @return JsonResponse
     */
    public function logout()
    {

        try {
            auth()->logout();
        } catch (\Exception $ex) {
            return $this->statusNG(null, __('lang.api.error'));
        }
        return $this->statusOK();
    }
    /**
     * Refresh a token.
     *
     * @return JsonResponse
     */
    public function refresh()
    {
        return AdminService::responseWithToken(auth()->refresh());
    }
}

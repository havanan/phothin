<?php

namespace Modules\Admin\Services;

use App\Base\Service\BaseService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Modules\Admin\Repositories\Admin\AdminRepository;

class AdminService extends BaseService
{

    /** @var AdminRepository $adminRepository */
    protected $adminRepository;

    public function __construct(
        AdminRepository $adminRepository
    ) {
        $this->adminRepository = $adminRepository;
    }

    /**
     * responseWithToken
     *
     * @param mixed $token
     * @return JsonResponse
     */
    public static function responseWithToken($token)
    {
        dd($token);
        return new JsonResponse([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('admin')->factory()->getTTL() * 60,
            'user' => auth('admin')->user()
        ]);
    }

    /**
     * @param $email
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findUserByEmail($email)
    {
        $input = ['email' => $email];
        return $this->adminRepository->findByField($input);
    }

    /**
     * @param $id
     * @param $data
     * @return bool|mixed
     */
    public function updateUser($id, $data)
    {
        $update = $this->adminRepository->update($id, $data);
        if ($update) {
            return $this->statusOK($update);
        }
        return $this->statusNG();
    }

    /**
     * changePassword
     *
     * @return JsonResponse
     */

    public function updatePassword($request)
    {
        $newPassword = $request->get('new_password');
        $oldPassword = $request->get('old_password');
        $info = auth('admin')->user();
        $checkOldPass = Hash::check($oldPassword, $info->password);
        if (!$checkOldPass) {
            return $this->statusNG([], __('lang.api.user.profile.password_incorrect'));
        }
        try {
            DB::beginTransaction();
            $info->password = bcrypt($newPassword);
            $info->updated_at = Carbon::now()->format(FORMAT_DATETIME);
            $info->save();
            DB::commit();
            return $this->statusOK();
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->statusNG(['error' => $ex->getMessage()]);
        }
    }
}

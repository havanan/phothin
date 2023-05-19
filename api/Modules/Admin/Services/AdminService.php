<?php

namespace Modules\Admin\Services;

use App\Base\Service\BaseService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Modules\Admin\Repositories\Admin\AdminRepository;
use Modules\Admin\Transformers\AdminTransformers;
use Modules\Admin\Transformers\AuthAdminTransformers;

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
        return new JsonResponse([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('admin')->factory()->getTTL() * 60,
            'user' => (new AuthAdminTransformers())->transform(auth('admin')->user())
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
     * @param int $userId
     * @param string $newPassword
     * @return JsonResponse
     */

    public function updatePassword($userId, $newPassword)
    {
        try {
            $info = $this->adminRepository->show($userId);
            DB::beginTransaction();
            $info->password = bcrypt($newPassword);
            $info->updated_at = Carbon::now()->format(FORMAT_DATETIME);
            $info->save();
            DB::commit();
            return $this->statusOK($info, 'Đổi mật khẩu thành công');
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->statusNG(['error' => $ex->getMessage()], 'Đổi mật khẩu thất bại');
        }
    }

    /**
     * @param int $userId
     * @param array $params
     * @return JsonResponse
     */

    public function updateProfile($userId, $params)
    {
        try {
            DB::beginTransaction();
            $info = $this->adminRepository->update($userId, $params);
            DB::commit();
            return $this->statusOK($info, 'Cập nhât thông tin thành công');
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->statusNG(['error' => $ex->getMessage()], 'Cập nhât thông tin thất bại');
        }
    }

    /**
     * @param $filter
     * @return JsonResponse
     */
    public function getList($filter)
    {
        $list = $this->adminRepository->getList($filter);
        return fractal($list)->transformWith(new AdminTransformers())->respond();
    }

    /**
     * @param $data
     * @return bool|mixed
     */

    public function create($params)
    {
        try {
            $params['author_id'] = auth()->guard('admin')->id();
            $this->adminRepository->create($params);
            return $this->statusOK('Tạo thành công');
        } catch (\Exception $e) {
            return $this->statusNG(null, $e->getMessage());
        }
    }

    /**
     * @param int $id
     * @param array $params
     * @return JsonResponse
     */
    public function update($id, $params)
    {
        try {
            $this->adminRepository->update($id, $params);
            return $this->statusOK('Cập nhật thành công');
        } catch (\Exception $e) {
            return $this->statusNG(null, $e->getMessage());
        }
    }


    /**
     * @param int $id
     * @return JsonResponse
     */
    public function deleteById($id)
    {

        try {
            $this->adminRepository->delete($id);
            return $this->statusOK('Xoá thành công');
        } catch (\Exception $e) {
            return $this->statusNG(null, $e->getMessage());
        }
    }
}

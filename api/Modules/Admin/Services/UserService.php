<?php

namespace Modules\Admin\Services;

use App\Base\Service\BaseService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Modules\Admin\Repositories\User\UserRepository;
use Modules\Admin\Transformers\UserTransformers;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserService extends BaseService
{

    /** @var UserRepository $userRepository */
    protected $userRepository;
    public function __construct(
        UserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    /**
     * @param $filter
     * @return JsonResponse
     */
    public function getList($filter)
    {
        $list = $this->userRepository->getList($filter);
        return fractal($list)->transformWith(new UserTransformers())->respond();
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function deleteById($id)
    {
        // try {
        //     UserDeleteEvent::dispatch($id);
        //     return $this->statusOK(__('lang.api.user.deleted'));
        // } catch (\Exception $e) {
        //     return $this->statusNG(null, $e->getMessage());
        // }
    }

    /**
     * @param int $id
     * @param array $params
     * @return JsonResponse
     */
    public function update($id, $params)
    {
        try {
            if (isset($params['email_verified'])) {
                if ($params['email_verified'] == ACTIVE) $data['email_verified_at'] = Carbon::now()->format('Y-m-d H:i:s');
                if ($params['email_verified'] == INACTIVE) $data['email_verified_at'] = null;
            }

            $data['status'] = $params['status'];
            $data['phone'] = $params['phone'];
            $this->userRepository->update($id, $data);
            return $this->statusOK(__('lang.api.user.updated'));
        } catch (\Exception $e) {
            return $this->statusNG(null, $e->getMessage());
        }
    }
    /**
     * @param int $id
     * @return JsonResponse
     */
    public function getFullUserInfo($id)
    {
        $info = $this->userRepository->show($id);
        return $this->statusOK($info);
    }
    /**
     * @param int $userId
     * @return JsonResponse
     */
    public function loginWithUserId($userId)
    {
        try {
            $info = $this->userRepository->show($userId);
            return $this->statusOK(JWTAuth::fromUser($info));
        } catch (\Exception $e) {
            return $this->statusNG(null, $e->getMessage());
        }
    }
    /**
     * @param int $userId
     * @param string $newPassword
     * @return JsonResponse
     */
    public function changePassword($userId, $newPassword)
    {
        try {
            $params = ['password' => bcrypt($newPassword)];
            $update = $this->userRepository->update($userId, $params);
            return $this->statusOK($update, 'Thay đổi mật khẩu thành công');
        } catch (\Exception $e) {
            return $this->statusNG(null, $e->getMessage());
        }
    }
}

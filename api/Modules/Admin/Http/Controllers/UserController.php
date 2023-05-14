<?php

namespace Modules\Admin\Http\Controllers;

use App\Base\Controller\BaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Admin\Filters\UserFilter;
use Modules\Admin\Http\Requests\User\ChangePasswordRequest;
use Modules\Admin\Http\Requests\User\UpdateUserRequest;
use Modules\Admin\Services\UserService;

class UserController extends BaseController
{
    /**
     * @var UserService $UserService
     */
    private $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * getListUser
     * @param UserFilter $filter
     * @return JsonResponse
     */
    public function list(UserFilter $filter)
    {
        return $this->userService->getList($filter);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $params = $request->only('status', 'phone');
        return $this->userService->update($id, $params);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        return $this->userService->deleteById($id);
    }

    /**
     * getUserInfo
     *
     * @return JsonResponse
     */
    public function user()
    {
        return $this->statusOK(auth('admin')->user());
    }
    /**
     * get User Info with invoice, ticket
     * @param int $id
     * @return JsonResponse
     */
    public function find($id)
    {
        return $this->userService->getFullUserInfo($id);
    }
    /**
     * getLoginFeToken
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getLoginFeToken($id)
    {
        return $this->userService->loginWithUserId($id);
    }
    /**
     * Chage Password
     *
     * @return JsonResponse
     */
    public function changePassw(ChangePasswordRequest $request)
    {
        $newPasss = $request->get('new');
        $userCurrent = auth('admin')->user();
        return $this->userService->changePassword($userCurrent->id, $newPasss);
    }
}

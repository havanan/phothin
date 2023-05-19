<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Filters\AdminFilter;
use Modules\Admin\Http\Requests\Admin\ChangePasswordRequest;
use Modules\Admin\Http\Requests\Admin\ProfileUpdateRequest;
use Modules\Admin\Services\AdminService;

class AdminController extends Controller
{
    protected $adminService;
    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function postCreate(Request $request)
    {
        $params = $request->only('name', 'email', 'phone', 'status', 'role_id', 'note', 'address', 'locations');
        return $this->adminService->create($params);
    }
    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function postUpdate(Request $request, $id)
    {
        $params = $request->only('name', 'phone', 'status', 'role_id', 'note', 'address', 'locations');
        return $this->adminService->update($id, $params);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        return $this->adminService->deleteById($id);
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
        return $this->adminService->updatePassword($userCurrent->id, $newPasss);
    }
    /**
     * Chage Info
     *
     * @return JsonResponse
     */
    public function changeInfo(ProfileUpdateRequest $request)
    {
        $params = $request->only('name', 'phone');
        $userId = $request->get('id');
        return $this->adminService->updateProfile($userId, $params);
    }
    /**
     * get List
     * @param AdminFilter $filter
     * @return JsonResponse
     */
    public function getList(AdminFilter $filter)
    {
        return $this->adminService->getList($filter);
    }
}

<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
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
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('admin::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('admin::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('admin::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('admin::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
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
    public function changeInfo(ProfileUpdateRequest $request)
    {
        $params = $request->only('name', 'phone');
        $userId = $request->get('id');
        return $this->adminService->updateProfile($userId, $params);
    }
}

<?php

namespace Modules\Admin\Http\Controllers;

use App\Base\Controller\BaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Admin\Filters\PointHistoryFilter;
use Modules\Admin\Filters\UserFilter;
use Modules\Admin\Filters\UserTicketFilter;
use Modules\Admin\Http\Requests\User\AddPointRequest;
use Modules\Admin\Http\Requests\User\CreateTicketRequest;
use Modules\Admin\Http\Requests\User\RemoveTicketRequest;
use Modules\Admin\Http\Requests\User\UpdateUserRequest;
use Modules\Admin\Services\ScheduleService;
use Modules\Admin\Services\TicketService;
use Modules\Admin\Services\UserService;

class UserController extends BaseController
{
    /**
     * @var UserService $UserService
     */
    private $userService;
    private $scheduleService;
    private $ticketService;
    public function __construct(UserService $userService, ScheduleService $scheduleService, TicketService $ticketService)
    {
        $this->userService = $userService;
        $this->scheduleService = $scheduleService;
        $this->ticketService = $ticketService;
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
        $params = $request->only('status', 'email_verified', 'is_notifiable', 'phone');
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
     * @param Request $request
     * @return JsonResponse
     */
    public function user(Request $request)
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
     * getListPending
     * @return \Illuminate\Http\JsonResponse
     */
    public function getListPending(Request $request)
    {
        $params = $request->all();
        return $this->scheduleService->getListPending($params);
    }
    /**
     * getListCompleted
     * @return \Illuminate\Http\JsonResponse
     */
    public function getListCompleted(Request $request)
    {
        $params = $request->all();
        return $this->scheduleService->getListCompleted($params);
    }
    /**
     * getListCanceled
     * @return \Illuminate\Http\JsonResponse
     */
    public function getListCanceled(Request $request)
    {
        $params = $request->all();
        return $this->scheduleService->getListCanceled($params);
    }
    /**
     * @param UserTicketFilter $filter
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUsertickets(UserTicketFilter $filter)
    {
        return $this->ticketService->getByUser($filter);
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
     * createticket
     * @return \Illuminate\Http\JsonResponse
     */

    public function createTicket(CreateTicketRequest $request)
    {
        $params = $request->only('ticket_id', 'user_id', 'expired_date', 'available_amount', 'status');
        return  $this->userService->createUserTicket($params);
    }

    /**
     * updateTicket
     * @return \Illuminate\Http\JsonResponse
     */

    public function updateTicket(Request $request, $id)
    {
        $params = $request->only('status', 'expired_date');
        return  $this->userService->updateUserTicket($id, $params);
    }

    /**
     * addPoint
     * @return \Illuminate\Http\JsonResponse
     */
    public function addPoint(AddPointRequest $request)
    {
        $params = $request->only('user_id', 'event_name', 'bonus_point');
        return $this->userService->addPoint($params);
    }
    /**
     * removeTicket
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeTicket(RemoveTicketRequest $request)
    {
        $params = $request->only('user_id', 'user_ticket_id');
        return $this->userService->removeTicket($params);
    }
    /**
     * getPointHistories
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPointHistories(PointHistoryFilter $filter)
    {
        return $this->userService->getPointHistories($filter);
    }
}

<?php

namespace Modules\Admin\Repositories\User;

use App\Base\Repository\EloquentRepository;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Modules\Admin\Filters\UserFilter;

class UserRepository extends EloquentRepository
{
    /**
     * getModel
     * @return string
     */
    public function getModel()
    {
        return User::class;
    }
    /**
     * getList
     * @param UserFilter $filter
     * @return JsonResponse
     */
    public function getList($filter){
       return $this->model->filter($filter)->paginate($filter->getPerPage());
    }
}

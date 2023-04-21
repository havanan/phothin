<?php

namespace Modules\Admin\Repositories\Admin;

use App\Base\Repository\EloquentRepository;
use App\Models\Admin;

class AdminRepository extends EloquentRepository
{
    /**
     * getModel
     * @return string
     */
    public function getModel()
    {
        return Admin::class;
    }
}

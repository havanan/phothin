<?php

namespace Modules\Admin\Filters;

use Modules\Admin\Filters\Fields\NameFilter;
use Modules\Admin\Filters\Fields\StatusFilter;
use App\Filters\AbstractFilter;

class AdminFilter extends AbstractFilter
{
    protected $filters = [
        'status' => StatusFilter::class,
        'name' => NameFilter::class,
        'created_at',
        'free_word',
        'id',
        'role_id'
    ];
    /**
     * role_id
     *
     * @param String $value
     * @return Builder
     */
    public function role_id($value)
    {
        return $this->builder->where('role_id', $value);
    }
    /**
     * created_at
     *
     * @param String $value
     * @return Builder
     */
    public function created_at($value)
    {
        return $this->builder->whereDate('created_at', '<=', $value);
    }
    /**
     * free_word
     *
     * @param  String $value
     * @return Builder
     */
    public function free_word($value = "")
    {

        return $this->builder
            ->where(function ($query) use ($value) {
                return $query
                    ->where('name', 'like', "%{$value}%")
                    ->orWhere('email', 'like', "%{$value}%")
                    ->orWhere('phone', 'like', "%{$value}%");
            });
    }
    /**
     * id
     *
     * @param Integer $value
     * @return Builder
     */
    public function id($value)
    {
        return $this->builder->where('id', $value);
    }
}

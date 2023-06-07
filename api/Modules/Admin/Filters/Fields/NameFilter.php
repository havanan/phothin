<?php

namespace Modules\Admin\Filters\Fields;

class NameFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('name', 'like', "%{$value}%");
    }
}

<?php

namespace Modules\Admin\Filters\Fields;

class StatusFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('status', (int) $value);
    }
}

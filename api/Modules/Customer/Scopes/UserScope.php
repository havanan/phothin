<?php

namespace Modules\Customer\Scopes;

use Illuminate\Database\Eloquent\Builder;

trait UserScope
{
    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('users.status', ACTIVE);
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeInactive(Builder $query): Builder
    {
        return $query->where('users.status', INACTIVE);
    }
}

<?php

namespace Modules\Customer\Scopes;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

trait CommonScope
{
    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where($this->getTableName() . 'status', ACTIVE);
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeInactive(Builder $query): Builder
    {
        return $query->where($this->getTableName() . 'status', INACTIVE);
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeFromNow(Builder $query): Builder
    {
        return $query->whereDate($this->getTableName() . 'created_at', '>=', Carbon::now());
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeCurrentUser(Builder $query): Builder
    {
        $user = currentCustomer();
        $userId = $user ? $user->id : 0;
        return $query->where($this->getTableName() . 'user_id', $userId);
    }
}

<?php

namespace Modules\Customer\Contracts;


interface MustVerify
{
    /**
     * Determine if the user has verified.
     *
     * @return bool
     */
    public function hasVerified();
}

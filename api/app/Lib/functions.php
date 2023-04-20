<?php

// use App\ActivityLog\ActivityLogger;
use App\Models\Admin;
use App\Models\User;



function currentCustomer(): User
{
    return auth()->guard('user')->user() ?? new User();
}
function currentAdmin(): Admin
{
    return auth()->guard('admin')->user() ?? new Admin();
}
// if (!function_exists('activity')) {
//     function activity(string $logName = null): ActivityLogger
//     {
//         $defaultLogName = config('activitylog.default_log_name');

//         return app(ActivityLogger::class)
//             ->useLog($logName ?? $defaultLogName)
//             ->url(request()->url());
//     }
// }

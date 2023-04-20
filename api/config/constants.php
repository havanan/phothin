<?php
// API meta code
if (!defined('HTTP_STATUS_SUCCESS')) {
    define('HTTP_STATUS_SUCCESS', 200);
}

if (!defined('HTTP_STATUS_SUCCESS_NO_CONTENT')) {
    define('HTTP_STATUS_SUCCESS_NO_CONTENT', 204);
}

if (!defined('HTTP_STATUS_BAD_REQUEST')) {
    define('HTTP_STATUS_BAD_REQUEST', 400);
}

if (!defined('HTTP_STATUS_UNAUTHORIZED')) {
    define('HTTP_STATUS_UNAUTHORIZED', 401);
}

if (!defined('HTTP_STATUS_FORBIDDEN')) {
    define('HTTP_STATUS_FORBIDDEN', 403);
}

if (!defined('HTTP_STATUS_NOT_FOUND')) {
    define('HTTP_STATUS_NOT_FOUND', 404);
}

if (!defined('HTTP_STATUS_METHOD_NOT_ALLOW')) {
    define('HTTP_STATUS_METHOD_NOT_ALLOW', 405);
}

if (!defined('HTTP_STATUS_NOT_ACCEPT')) {
    define('HTTP_STATUS_NOT_ACCEPT', 406);
}

if (!defined('HTTP_STATUS_WRONG_PARAM')) {
    define('HTTP_STATUS_WRONG_PARAM', 412);
}

// Status
if (!defined('INACTIVE')) {
    define('INACTIVE', 0);
}

if (!defined('ACTIVE')) {
    define('ACTIVE', 1);
}

if (!defined('IS_SEEN')) {
    define('IS_SEEN', 2);
}

if (!defined('VERIFY_MAIL_STATUS')) {
    define('VERIFY_MAIL_STATUS', 2);
}

// Paginate
if (!defined('LIMIT_PAGINATE')) {
    define('LIMIT_PAGINATE', [
        10, 25, 50, 100,
    ]);
}

if (!defined('ACCESS_IMAGE_EXTENSION')) {
    define('ACCESS_IMAGE_EXTENSION', [
        'png', 'jpg', 'jpeg', 'gif',
    ]);
}

if (!defined('ACCESS_VIDEO_EXTENSION')) {
    define('ACCESS_VIDEO_EXTENSION', [
        'mp4', 'MP4',
    ]);
}

// Error code API
if (!defined('ERROR_CODE')) {
    define('ERROR_CODE', [
        'UNVERIFIED_EMAIL' => 'AN-1001', // Email is not verified
        'UNAUTHORIZED' => 'AN-1002', // User is not authorized
        'USER_NOT_FOUND' => 'AN-1003', // User is not found
        'VALIDATE_FAIL' => 'AN-1004', // Validate fail
        'RESEND_VERIFY_EMAIL_FAIL' => 'AN-1005', // When validate resend verify email fail
        'TOKEN_NOT_FOUND' => 'AN-1006', // Token Reset Password Not Found
        'PASSWORD_INCORRECT' => 'AN-1007', // Password is incorrect
        'TOKEN_EXPIRED' => 'AN-1008', // Token is expired
        'TOKEN_INVALID' => 'AN-1009', // Token invalid
        'TOKEN_REQUIRE' => 'AN-1010', // Token require
        'MAXIMUM_DEVICE_REACH' => 'AN-1011', // Maximum device reach
        'GATE_NOT_ACCESS' => 'GA-0001', // Access denied with GATE,
        'PHONE_CODE_VERYFY_TIME_LIMIT' => 'PC-0001', // Limit send phone code
        'PHONE_VERIFIED' => 'PC-0002', // Phone number is existed in user table
        'UNVERIFIED_PHONE' => 'AN-1012', // Phone verify require,
        'EMAIL_ALREADY_EXISTS' => 'AN-1013', // Email is already exists
        'PHONE_NOT_EXIST' => 'AN-1014', // Email is already exists
        'REQUIRE_PHONE_AND_EMAIL' => 'AN-1015', // Require phone number and email
        'REQUIRE_ACTIVE_ZOOM_ACCOUNT' => 'AN-1016', // Require active zoom account
        'LIMIT_REVIEW_A_DAY' => 'AN-1017'
    ]);
}

if (!defined('DEFAULT_COMMENT_PER_PAGE')) {
    define('DEFAULT_COMMENT_PER_PAGE', 5);
}

if (!defined('SEND_MESSAGE_ALARM_STUDENT')) {
    define('SEND_MESSAGE_ALARM_STUDENT', 1);
}

if (!defined('DEFAULT_PER_PAGE')) {
    define('DEFAULT_PER_PAGE', 10);
}

if (!defined('LIMIT_PER_PAGE')) {
    define('LIMIT_PER_PAGE', 1000);
}

if (!defined('USER_AVARTAR_FOLDER')) {
    define('USER_AVARTAR_FOLDER', 'users/avatars');
}

if (!defined('DEFAULT_FORMAT_DATETIME')) {
    define('DEFAULT_FORMAT_DATETIME', 'Y-m-d H:i:s');
}
if (!defined('LINE_CHART')) {
    define('LINE_CHART', 'line');
}
if (!defined('PIE_CHART')) {
    define('PIE_CHART', 'pie');
}

if (!defined('SOURCE_LANG')) {
    define('SOURCE_LANG', [
        'ko' => ['en', 'vi'],
        'en' => ['ko', 'vi'],
        'vi' => ['en', 'ko'],
    ]);
}

if (!defined('CURRENCY_RATE')) {
    define('CURRENCY_RATE', 1228.91);
}

if (!defined('PREFIX_ORDER_ID')) {
    define('PREFIX_ORDER_ID', 'AN-');
}

if (!defined('POLICY_MAIL_CYCLE')) {
    define('POLICY_MAIL_CYCLE', 2); // YEAR
}

if (!defined('TERM_MAIL_CYCLE')) {
    define('TERM_MAIL_CYCLE', 1); // YEAR
}

if (!defined('FORMAT_DATETIME')) {
    define('FORMAT_DATETIME', 'Y-m-d H:i:s');
}

if (!defined('FORMAT_DATE')) {
    define('FORMAT_DATE', 'Y-m-d');
}

if (!defined('ACCEPT_LOCALES')) {
    define('ACCEPT_LOCALES', ['en', 'vi', 'ko']);
}

if (!defined('LIMIT_DAY_ADD_SCHEDULE')) {
    define('LIMIT_DAY_ADD_SCHEDULE', 1); // days
}

if (!defined('AUTO_CANCEL_HOUR')) {
    define('AUTO_CANCEL_HOUR', 12); // hours
}

if (!defined('MAX_TIME_COURSE')) {
    define('MAX_TIME_COURSE', 40); // minutes
}

if (!defined('TIME_PREPARE_FOR_COURSE')) {
    define('TIME_PREPARE_FOR_COURSE', 15); // minutes
}

if (!defined('TIME_SEND_MAIL_FIRST_TIME_READY_FOR_CLASS')) {
    define('TIME_SEND_MAIL_FIRST_TIME_READY_FOR_CLASS', 60); // minutes
}

if (!defined('TIME_SEND_MAIL_READY_FOR_CLASS')) {
    define('TIME_SEND_MAIL_READY_FOR_CLASS', 15); // minutes
}

if (!defined('TIME_SEND_SMS_READY_FOR_CLASS')) {
    define('TIME_SEND_SMS_READY_FOR_CLASS', 30); // minutes
}

if (!defined('USER_ACTIONS')) {
    define('USER_ACTIONS', [
        'ENTER_CLASS' => 'H1000',
    ]); // minutes
}
if (!defined('TEXTBOOK_FILE_NAME_DOWNLOAD')) {
    define('TEXTBOOK_FILE_NAME_DOWNLOAD', 'textbook_');
}
if (!defined('PENDING_ZOOM_STATUS')) {
    define('PENDING_ZOOM_STATUS', 'pending');
}

if (!defined('JP_LEVEL')) {
    define('JP_LEVEL', [0, 1, 2, 3]);
}

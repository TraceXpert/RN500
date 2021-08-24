<?php

return [
    'adminEmail' => 'info@rn500.com',
    'logPath' => "@app/runtime/logs",
    'jwtTokenInfo' => [
        "key" => "8439ae35149b1a49454ea703f148330aae0ad457c98608a535b33b4bbf53abe6"
    ],
    'disableAuth' => [
        'auth/login',
        'auth/registration',
        'auth/forgotpassword',
        'auth/get-user-ip',
        'auth/register',
        'auth/checkemail',
        'auth/resend-otp',
        'browse-jobs/leads',
        'browse-jobs/views',
        'browse-jobs/refer-to-friend',
        'advertisement/get-list',
        'blogs/get-list',
        'blogs/detail',
    ],
    'maintenance_mode' => 'OFF',
    'session_expire' => '+48 hours',
    'API_PAGINATION_RECORD_LIMIT' => 10
];

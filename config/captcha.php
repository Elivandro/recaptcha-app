<?php

return [
    'secret'    => env('GOOGLE_RECAPTCHA_SECRET'),
    'sitekey'   => env('GOOGLE_RECAPTCHA_SITEKEY'),
    'options'   => [
        'timeout' => 50,
    ],
];
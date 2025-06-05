<?php

return [
    'moj' => [
        'base_uri' => env('MOJ_EFILING_BASE_URI', 'https://api.moj.gov.mock'),
        'api_key' => env('MOJ_EFILING_API_KEY'),
    ],
    'adjd' => [
        'base_uri' => env('ADJD_EFILING_BASE_URI', 'https://api.adjd.gov.mock'),
        'api_key' => env('ADJD_EFILING_API_KEY'),
    ],
    'dubai' => [
        'base_uri' => env('DUBAI_EFILING_BASE_URI', 'https://api.dubaicourts.mock'),
        'api_key' => env('DUBAI_EFILING_API_KEY'),
    ],
    'rak' => [
        'base_uri' => env('RAK_EFILING_BASE_URI', 'https://api.rakcourts.mock'),
        'api_key' => env('RAK_EFILING_API_KEY'),
    ],
];

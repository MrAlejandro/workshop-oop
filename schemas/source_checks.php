<?php

use App\Enum\SourceTypes;

return [
    SourceTypes::FILE => [
        'file_exists' => function ($file_path) {
            return file_exists($file_path);
        },
    ],
    SourceTypes::URL => [
        'is_valid_url' => function ($url) {
            return filter_var($url, FILTER_VALIDATE_URL) !== false;
        },
    ],
];
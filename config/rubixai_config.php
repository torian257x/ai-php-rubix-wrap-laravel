<?php

use Torian257x\RubWrap\Service\RubixService;

return [
    'csv_path_output' => storage_path('/ai_rubix/csv/'),
    'csv_path_input' => storage_path('/ai_rubix/csv/'),
    'ai_model_path_output' => storage_path('/ai_rubix/model/'),
    'RubixMainClass' => RubixService::class,
];

<?php

// This file has been auto-generated by the Symfony Routing Component.

return [
    '_preview_error' => [['code', '_format'], ['_controller' => 'error_controller::preview', '_format' => 'html'], ['code' => '\\d+'], [['variable', '.', '[^/]++', '_format', true], ['variable', '/', '\\d+', 'code', true], ['text', '/_error']], [], [], []],
    'calculate_travel' => [[], ['_controller' => 'App\\Controller\\CalculateTravelController::calculatePrice'], [], [['text', '/calculate-travel']], [], [], []],
    'App\Controller\CalculateTravelController::calculatePrice' => [[], ['_controller' => 'App\\Controller\\CalculateTravelController::calculatePrice'], [], [['text', '/calculate-travel']], [], [], []],
];

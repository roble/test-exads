<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../src/app/config/config.php';

$page = $_GET['page'] ?? 'home';

if (file_exists($view = __DIR__ . "/../src/app/views/{$page}.php")) {
    return require $view;
}

include(__DIR__ . "/../src/app/views/404.error.php");

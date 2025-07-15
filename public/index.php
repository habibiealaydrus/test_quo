<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));
//perhatikan struktur folder karena sangat penting
// tanda ../ artinya naik satu tingkat, ../../ artinya 2 tingkat
// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__ . '/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...

require __DIR__ . '/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);
$response->send();
$kernel->terminate($request, $response);

$app->bind('path.public', function () {
    return __DIR__;
});

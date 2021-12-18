<?php

$env = file_get_contents($_SERVER['DOCUMENT_ROOT']."/core/.env");
$env_exp = explode("=", @$env);
if(!@$env_exp[0]) {
	die('<script>window.location.href = "/install/index.php";</script>');
}

define('LARAVEL_START', microtime(true));
require __DIR__.'/core/vendor/autoload.php';

$app = require_once __DIR__.'/core/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);
$response->send();
$kernel->terminate($request, $response);
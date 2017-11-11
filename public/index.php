<?php
declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PATCH');
header('Access-Control-Allow-Headers: content-type');
header("Content-Type: text/plain application/x-www-form-urlencoded");

use pantry\App;

$app = new App();
$app->run();

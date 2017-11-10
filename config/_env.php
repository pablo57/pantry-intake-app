<?php
declare(strict_types=1);

use Dotenv\Dotenv;

$dotEnv = new Dotenv(__DIR__ . '/../');
$dotEnv->load();

$dotEnv->required(
    [
        'DB_HOST',
        'DB_PORT',
        'DB_NAME',
        'DB_USER',
        'DB_PASSWORD',
    ]
);
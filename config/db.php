<?php
declare(strict_types=1);

use Interop\Container\ContainerInterface;
use Illuminate\Database\Capsule\Manager as Capsule;

return [
    'db.dsn' => 'mysql:host=' . getenv('DB_HOST') . ';port=' . getenv('DB_PORT') . ';dbname=' . getenv('DB_NAME'),
    'db.host' => getenv('DB_HOST'),
    'db.user' => getenv('DB_USER'),
    'db.password' => getenv('DB_PASSWORD'),
    'db.schema' => getenv('DB_NAME'),

    Capsule::class => function (ContainerInterface $c) {
        $eloquent = new Capsule;

        $eloquent->addConnection([
            'driver'    => 'mysql',
            'host'      => $c->get('db.host'),
            'database'  => $c->get('db.schema'),
            'username'  => $c->get('db.user'),
            'password'  => $c->get('db.password'),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]);

        // Make this Capsule instance available globally via static methods... (optional)
        $eloquent->setAsGlobal();

        // Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
        $eloquent->bootEloquent();

        $eloquent->setFetchMode(PDO::FETCH_ASSOC);

        return $eloquent;
    }
];




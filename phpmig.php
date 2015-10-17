<?php

use \Phpmig\Adapter;
use \Phpmig\Pimple\Pimple,
    \Illuminate\Database\Capsule\Manager as Capsule;

$container = new Pimple();

$container['config'] = [
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'uom_connect1',
    'username'  => 'root',
    'password'  => '',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
];

$container['db'] = $container->share(function() use ($container) {
    $capsule = new Capsule();
    $capsule->addConnection($container['config']);
    $capsule->setAsGlobal();
    $capsule->bootEloquent();

    return $capsule;
});

$container['phpmig.adapter'] = $container->share(function() use ($container) {
    return new Adapter\Illuminate\Database($container['db'], 'migrations');
});
$container['phpmig.migrations_path'] = function() {
    return __DIR__ . DIRECTORY_SEPARATOR . 'migrations';
};
$container['phpmig.migrations_template_path'] = function() {
    return __DIR__ . DIRECTORY_SEPARATOR . 'migrations/template/migration-template.php';
};

return $container;
<?php

use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'cms',
    'username'  => 'root',
    'password'  => 'sbFmFM8ggOb93AO5M3DvDpXz7EF2pNAx',
    'charset'   => 'utf8',
    'collation' => 'utf8_general_ci',
    'prefix'    => '',
]);

$capsule->setAsGlobal();

$capsule->bootEloquent();
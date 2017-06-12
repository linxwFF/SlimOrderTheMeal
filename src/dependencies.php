<?php
// DIC configuration

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};


// Service factory for the ORM
$container['db'] = function ($container) {
    $capsule = new \Illuminate\Database\Capsule\Manager;    //实例化一个ORM类
    $capsule->addConnection($container['settings']['db']);  //创建连接

    $capsule->setAsGlobal();
    $capsule->bootEloquent();

    return $capsule;
};

// 传递数据表实例到控制器
$container['WidgetController'] = function ($c) {
    $table = $c->get('db')->table('user');
    return new \App\Controllers\WidgetController($table);
};

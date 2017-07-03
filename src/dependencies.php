<?php
// DIC configuration

$container = $app->getContainer();

// view renderer  注册视图的组件
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

/*
// Service factory for the ORM   //懒汉式调用   //要曾经调用过才会有这个实例在内存里
$container['db'] = function ($container) {
    $capsule = new \Illuminate\Database\Capsule\Manager;    //实例化一个ORM类
    $capsule->addConnection($container['settings']['db']);  //创建连接

    $capsule->setAsGlobal();
    $capsule->bootEloquent();

    return $capsule;
};
*/

$capsule = new \Illuminate\Database\Capsule\Manager;    //实例化一个ORM类
$capsule->addConnection($container['settings']['db']);  //创建连接
$capsule->setAsGlobal();
$capsule->bootEloquent();
$container['db'] = function ($container) {
    global $capsule;
    return $capsule;
};


// 传递数据表实例到控制器
$container['WidgetController'] = function ($c) {
    $renderer = $c->get('renderer');    //获取容器中的视图组件
    return new \App\Controllers\WidgetController($renderer);
};


$container['OrderTheMealController'] = function ($c) {
    $renderer = $c->get('renderer');    //获取容器中的视图组件
    return new \App\Controllers\OrderTheMealController($renderer);  //通过构造方法的注入视图组件
};

$container['SearchController'] = function ($c) {
    $renderer = $c->get('renderer');    //获取容器中的视图组件
    return new \App\Controllers\SearchController($renderer);  //通过构造方法的注入视图组件
};

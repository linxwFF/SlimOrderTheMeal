<?php
// Routes

// 首页
$app->get('/', function ($request, $response, $args) {
    return $this->renderer->render($response, 'index.phtml', $args);
});

// 点击首页的餐品，进入餐品详细页面
$app->get('/detail/[{id}]', function ($request, $response, $args) {

    var_dump($args);
    return $this->renderer->render($response, 'detail.phtml', $args);
});

// 文章
$app->get('/article', function ($request, $response, $args) {

    return $this->renderer->render($response, 'article.phtml', $args);
});

// 关于我们店
$app->get('/about', function ($request, $response, $args) {

    return $this->renderer->render($response, 'about.phtml', $args);
});
//地图
$app->get('/map', function ($request, $response, $args) {

    return $this->renderer->render($response, 'map.phtml', $args);
});


// 生成的订单
$app->get('/order', function ($request, $response, $args) {

    return $this->renderer->render($response, 'order.phtml', $args);
});

// 后台的订单列表

$app->get('/getTest', 'WidgetController:getTest');

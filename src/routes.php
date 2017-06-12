<?php
// Routes

// 首页
$app->get('/', 'OrderTheMealController:index');
// 点击首页的餐品，进入餐品详细页面
$app->get('/detail/[{id}]', 'OrderTheMealController:detail');
//添加购物车
$app->post('/addCar/[{id}]', 'OrderTheMealController:addCar');
//删除购物车
$app->post('/delCar/[{id}]', 'OrderTheMealController:delCar');
// 显示购物车    //根据座位
$app->get('/showCar/[{seat}]', 'OrderTheMealController:showCar');
// 生成购物订单
$app->post('/addOrder/[{seat}]', 'OrderTheMealController:addOrder');
// 订单列表
$app->get('/listOrder/[{seat}]', 'OrderTheMealController:listOrder');


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

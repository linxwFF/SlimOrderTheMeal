<?php
// Routes

$app->get('/hello/[{name}]', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");
    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});


$app->get('/getTest', 'WidgetController:getTest');

// 选择座位
$app->get('/chooseSeat', function ($request, $response, $args) {


    return $this->renderer->render($response, 'chooseSeat.phtml', $args);
});

//选择座位
$app->get('/chooseSeat/[{id}]', function ($request, $response, $args) {

    echo $args;
    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});

<?php

namespace App\Controllers;

use Slim\Views\PhpRenderer;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Illuminate\Database\Query\Builder;
use App\Models\Order as Order;
use App\Models\Menu as Menu;
use App\Models\OrderList as OrderList;

class OrderTheMealController
{
    private $renderer;
    // private static $_SESSION

    public function __construct(PhpRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    //首页
    public function index($request, $response)
    {
        $data = Menu::get();
        return $this->renderer->render($response, 'index.phtml', ['data' => $data]);
    }

    //商品详细页
    public function detail($request, $response, $args)
    {
        $data = Menu::find($args['id']);
        return $this->renderer->render($response, 'detail.phtml', ['data' => $data]);
    }

    //加入购物车
    public function addCar($request, $response, $args)
    {
        $goodId = $args['id'];    //商品ID

        $arr = @$_SESSION['shop_cart'];

        if (@array_key_exists($goodId, $arr)) {
            //该商品添加过购物车，进行数量加1的操作
            $a = $arr[$goodId]['goods_num'] ++;
            // echo '存在该商品' . $arr[$goodId]['goods_num']."<br/>";
        } else {
            //该商品为新商品添加到购物车
            //arr0为要添加已存在购物车数组arr的新购物车数组
            //菜单信息
            $goods_detail = Menu::find($goodId);
            $arr0 = [
                $goodId => [
                    'goods_num' => 1, //商品数量
                    'goods_detail' => $goods_detail,
                ]
            ];

            foreach ($arr0 as $key => $value) {
                $arr[$key] = $value;
            }
        }

        $_SESSION['shop_cart'] = $arr;

        // session_destroy();

        return $response->withJson($_SESSION['shop_cart']); //返回购物车信息
    }

    //删除购物车
    public function delCar($request, $response, $args)
    {
        echo $args['id'];
    }

    //显示购物车内容
    public function showCar($request, $response, $args)
    {
        $data = @$_SESSION['shop_cart'];     //购物车信息

        $count = 0; //商品总数量
        $tatal = 0; //商品总价钱

        if(isset($data)){
            foreach ($data as $key => $value) {
                $count += $value['goods_num'];
                $data[$key]['total'] = sprintf("%.2f", $value['goods_detail']->unit_price * $value['goods_num']);
                $tatal += $value['goods_detail']->unit_price;
            }
        }

        $_SESSION['shop_cart'] = $data;
        // return $response->withJson($data); //返回购物车信息

        return $this->renderer->render($response, 'car.phtml', ['data' => $data ,'count' => $count, 'tatal' => sprintf('%.2f', $tatal)]);
    }

    //根据购物车生成订单
    public function addOrder($request, $response, $args)
    {
        $data = @$_SESSION['shop_cart'];

        if(isset($data)){
            $order = new Order;
            $order->user_id = 1;
            $order->status = 0;
            $order->save();
            $order_id = $order['id'];

            foreach ($data as $key => $value) {
                $order_list = new OrderList;
                $order_list->order_id = $order_id;
                $order_list->name = $value['goods_detail']['name'];
                $order_list->number = $value['goods_num'];
                $order_list->price = $value['goods_detail']['unit_price'];
                $order_list->total_price = $value['total'];
                $order_list->save();
            }

            $msg = "添加成功";
        }else{
            $msg = "没有数据无法添加";
        }

        //清除购物车
        unset($_SESSION['shop_cart']);

        return $response->withStatus(201)->withJson($msg); //返回购物车信息  201 Created
    }

    // 订单列表
    public function listOrder($request, $response, $args)
    {
        $list = Order::where('seat_id',$seat)->where('status', 0)->get()->toArray();

        return $this->renderer->render($response, 'order.phtml', ['data' => $list]);
    }

}

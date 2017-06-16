<?php

namespace App\Controllers;

use Slim\Views\PhpRenderer;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Illuminate\Database\Query\Builder;
use App\Models\Order as Order;
use App\Models\Menu as Menu;

class OrderTheMealController
{
    private $renderer;

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
        $seat = 1;  //座位号
        $goodId = $args['id'];    //商品ID
        $arr = $_SESSION['shop_cart'][$seat] ? $_SESSION['shop_cart'][$seat] : [];

        if (array_key_exists($goodId, $arr)) {
            //该商品添加过购物车，进行数量加1的操作
            $a = $arr[$goodId]['goods_num'] ++;
            // echo '存在该商品' . $arr[$goodId]['goods_num']."<br/>";
        } else {
            //该商品为新商品添加到购物车
            //arr0为要添加已存在购物车数组arr的新购物车数组
            $arr0 = [
                $goodId => [
                    'goods_num' => 1, //商品数量
                ]
            ];

            foreach ($arr0 as $key => $value) {
                $arr[$key] = $value;
            }
        }

        $_SESSION['shop_cart'][$seat] = $arr;

        // session_destroy();
        echo "1";

    }
    //删除购物车
    public function delCar($request, $response, $args)
    {
        echo $args['id'];
    }

    //显示购物车内容
    public function showCar($request, $response, $args)
    {
        $data = $_SESSION['shop_cart'][$args['seat']];     //购物车信息
        $count = 0;

        if(isset($data)){
            $ids = array_keys($data);   //获取IDs
            $goods_detail = Menu::whereIn('id', $ids)->get();
            foreach ($data as $key => $value) {
                foreach ($goods_detail as $kk => $vv) {
                    if($vv->id == $key){
                        $data[$key]['goods_detail'] = $vv;
                        $data[$key]['total'] = sprintf("%.2f", $vv->unit_price * $value['goods_num']);
                    }
                }
                $count += $value['goods_num'];
            }
            $_SESSION['shop_cart'][$args['seat']] = $data;
        }

        return $this->renderer->render($response, 'car.phtml', ['data' => $data ,'count' => $count]);
    }

    //根据购物车生成订单
    public function addOrder($request, $response, $args)
    {
        $data = $_SESSION['shop_cart'][$args['seat']];
        $seat_id = $args['seat'];
        foreach ($data as $key => $value) {
            $menu_id = $key;
            $goods_num = $value['goods_num'];

            $order = new Order;
            $order->seat_id = $seat_id;
            $order->menu_id = $menu_id;
            $order->goods_num = $goods_num;
            $order->status = 0; //代表没有确认
            $order->save();
        }

        //清除购物车
        session_destroy();

        echo "提交订单成功";
    }

    // 订单列表
    public function listOrder($request, $response, $args)
    {
        $seat = $args['seat'];
        $list = Order::where('seat_id',$seat)->where('status', 0)->get()->toArray();

        return $this->renderer->render($response, 'order.phtml', ['data' => $list]);
    }

}

<?php

namespace App\Controllers;

use Slim\Views\PhpRenderer;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Illuminate\Database\Query\Builder;
use App\Models\Menu as Menu;

class SearchController
{
    private $renderer;

    public function __construct(PhpRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    // 全部菜单
    public function index($request, $response)
    {
        $data = Menu::get();
        return $response->withJson($data);
        return $this->renderer->render($response, 'search.phtml', ['data' => $data]);
    }

    //搜索菜单
    public function search($request, $response)
    {
        $keywords = $_POST['keywords'];
        $data = Menu::where('name', 'like', '%'.$keywords.'%')->get();
        return $response->withJson($data);
    }

    //分类菜单
    public function category($request, $response, $args)
    {
        $category_id = $args['id'];
        $data = Menu::from('menu as m')
                    ->join('category as c', 'm.c_id', '=', 'c.id')
                    ->where('m.c_id',$category_id)
                    ->get([
                        'm.id',
                        'm.name',
                        'm.unit_price',
                        'm.img_url',
                        'm.description',
                        'm.number',
                        'm.c_id',
                        'm.updated_at',
                        'm.created_at',
                        'c.name as category_name',
                        'c.desc',
                    ]);
        return $response->withJson($data);
    }
}

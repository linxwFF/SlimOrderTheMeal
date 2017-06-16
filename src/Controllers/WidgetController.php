<?php

namespace App\Controllers;

use Slim\Views\PhpRenderer;
use Illuminate\Database\Query\Builder;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Models\Menu as Menu;

class WidgetController
{
    private $renderer;

    public function __construct(PhpRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    public function getTest($request, $response, $args)
    {
        $record = Menu::all()->toArray();
        print_r($record);
    }
}

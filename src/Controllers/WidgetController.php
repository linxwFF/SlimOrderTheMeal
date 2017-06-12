<?php

namespace App\Controllers;

use Slim\Views\PhpRenderer;
use Illuminate\Database\Query\Builder;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class WidgetController
{
    protected $table;
    private $renderer;

    public function __construct(Builder $table, PhpRenderer $renderer)
    {
        $this->table = $table;
        $this->renderer = $renderer;
    }

    public function getTest($request, $response, $args)
    {
        $record = $this->table->find(1);
        print_r($record);
    }
}

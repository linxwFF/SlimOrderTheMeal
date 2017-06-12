<?php

namespace App\Controllers;

use Slim\Views\Twig;
use Psr\Log\LoggerInterface;
use Illuminate\Database\Query\Builder;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class WidgetController
{
    protected $table;

    public function __construct(Builder $table)
    {
        $this->table = $table;
    }

    public function getTest($request, $response, $args)
    {
        $record = $this->table->find(1);
        print_r($record);
    }
}

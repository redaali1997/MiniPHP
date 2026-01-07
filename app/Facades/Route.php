<?php
namespace App\Facades;

use App\Facade;
use App\Router;

class Route extends Facade {
    protected static function getFacadeAccessor() {
        return Router::class;
    }
}
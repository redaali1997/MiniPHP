<?php

use App\App;
use App\Controllers\HomeController;
use App\Controllers\TaskController;
use App\Facades\Route;
use App\Interfaces\UserRepositoryInterface;
use App\Middlewares\AuthMiddleware;
use App\Middlewares\TrimStrings;
use App\Repositories\UserRepository;
use App\Router;

require_once __DIR__ . '/../vendor/autoload.php';

$router = new Router();
$container = $router->container;
$container->setInstance(Router::class, $router);
App::setContainer($container);

// middlewares
Route::addMiddleware(TrimStrings::class);
Route::addMiddleware(AuthMiddleware::class);

// web
Route::get('/', [HomeController::class, 'index']);
Route::post('/store', [HomeController::class, 'store']);

// api
Route::get('/api/tasks', [TaskController::class, 'index']);
Route::post('/api/tasks', [TaskController::class, 'store']);
Route::put('/api/tasks', [TaskController::class, 'update']);
Route::delete('/api/tasks', [TaskController::class, 'delete']);

// container binding
$container->bind(UserRepositoryInterface::class, UserRepository::class);

Route::resolve();
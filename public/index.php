<?php

use App\Controllers\HomeController;
use App\Controllers\TaskController;
use App\Interfaces\UserRepositoryInterface;
use App\Middlewares\AuthMiddleware;
use App\Middlewares\TrimStrings;
use App\Pipeline;
use App\Repositories\UserRepository;
use App\Router;

require_once __DIR__ . '/../vendor/autoload.php';

$router = new Router();

// middlewares
$router->addMiddleware(TrimStrings::class);
$router->addMiddleware(AuthMiddleware::class);

// web
$router->get('/', [HomeController::class, 'index']);
$router->post('/store', [HomeController::class, 'store']);

// api
$router->get('/api/tasks', [TaskController::class, 'index']);
$router->post('/api/tasks', [TaskController::class, 'store']);
$router->put('/api/tasks', [TaskController::class, 'update']);
$router->delete('/api/tasks', [TaskController::class, 'delete']);

// container binding
$router->bind(UserRepositoryInterface::class, UserRepository::class);

$router->resolve();
<?php

use App\Controllers\HomeController;
use App\Controllers\TaskController;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\UserRepository;
use App\Router;

require_once __DIR__ . '/../vendor/autoload.php';

$router = new Router();

$router->get('/', [HomeController::class, 'index']);
$router->post('/store', [HomeController::class, 'store']);

// api
$router->get('/api/tasks', [TaskController::class, 'index']);
$router->post('/api/tasks', [TaskController::class, 'store']);
$router->put('/api/tasks', [TaskController::class, 'update']);
$router->delete('/api/tasks', [TaskController::class, 'delete']);

$router->bind(UserRepositoryInterface::class, UserRepository::class);
$router->resolve();
<?php
namespace App;

class Router {
    protected array $routes = [];

    public function get(string $path, $callback) {
        $this->routes['get'][$path] = $callback;
    }

    public function post(string $path, $callback) {
        $this->routes['post'][$path] = $callback;
    }

    public function put(string $path, $callback)
    {
        $this->routes['put'][$path] = $callback;
    }

    public function delete(string $path, $callback)
    {
        $this->routes['delete'][$path] = $callback;
    }

    public function resolve() {
        $path = $_SERVER['REQUEST_URI'];
        $method = strtolower($_SERVER['REQUEST_METHOD']);

        $position = strpos($path, '?');
        if($position !== false) {
            $path = substr($path, 0, $position);
        }

        $callback = $this->routes[$method][$path] ?? false;

        if(!$callback) {
            echo "404 - Not Found";
            return;
        }

        if (is_array($callback)) {
            $callback[0] = new $callback[0]();
        }

        echo call_user_func($callback);
    }
}
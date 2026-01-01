<?php
namespace App\Controllers;

class Controller {
    public function render($view, $data = []) {
        extract($data);

        $path = __DIR__ . '/../../views/' . $view . '.php';

        if(file_exists($path)) {
            ob_start();
            include $path;
            return ob_get_clean();
        } else {
            return "View [$view] not found!";
        }
    }
}

<?php
namespace App\Controllers;

use App\Database;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $userModel = new User();
        $users = $userModel->getAllUsers();

        $data = [
            'page_title' => 'قائمة المستخدمين',
            'users_list' => $users
        ];
        return $this->render('home', $data);
    }

    public function store() {
        $name = $_POST['name'];
        $email = $_POST['email'];

        $userModel = new User();
        $userModel->create($name, $email);

        header('Location: /');
        return;
    }
}
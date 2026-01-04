<?php
namespace App\Controllers;

use App\Models\User;

class HomeController extends Controller
{
    public function __construct(private User $user)
    {
        //
    }

    public function index()
    {
        $users = $this->user->getAllUsers();

        $data = [
            'page_title' => 'قائمة المستخدمين',
            'users_list' => $users
        ];
        return $this->render('home', $data);
    }

    public function store() {
        $name = $_POST['name'];
        $email = $_POST['email'];

        $this->user->create($name, $email);

        header('Location: /');
        return;
    }
}
<?php
namespace App\Controllers;

use App\Interfaces\UserRepositoryInterface;

class HomeController extends Controller
{
    public function __construct(private UserRepositoryInterface $userRepositoryInterface)
    {
        //
    }

    public function index()
    {
        $users = $this->userRepositoryInterface->getAllUsers();

        $data = [
            'page_title' => 'قائمة المستخدمين',
            'users_list' => $users
        ];
        return $this->render('home', $data);
    }

    public function store() {
        $name = $_POST['name'];
        $email = $_POST['email'];

        $this->userRepositoryInterface->create($name, $email);

        header('Location: /');
        return;
    }
}
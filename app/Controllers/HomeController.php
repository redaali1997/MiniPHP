<?php
namespace App\Controllers;

use App\Interfaces\UserRepositoryInterface;
use App\Validator;

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

    public function store()
    {
        // XSS Protection
        $cleanedData = Validator::sanitize($_POST);

        $validator = new Validator();
        $isValid = $validator->validate($cleanedData, [
            'name' => 'required|string|min:3',
            'email' => 'required|email'
        ]);

        if (!$isValid) {
            header('Content-Type: application/json');
            echo json_encode(['errors' => $validator->getErrors()]);
            exit;
        }

        $this->userRepositoryInterface->create($cleanedData['name'], $cleanedData['email']);

        header('Location: /');
        return;
    }
}
<?php

namespace App\Controllers;

use Config\Controller\Action;
use App\Models\User;

class UsersController extends Action
{

    protected $data = null;

    public function signIn()
    {
        $this->render("User/signin.phtml", "defaultLayout1");
    }

    public function registerUser()
    {
        $user = new User();
        $user->__set('nome', $_POST['nome']);
        $user->__set('email', $_POST['email']);
        $user->__set('senha', $_POST['senha']);

        if ($user->validateRegister()) {
            if (count($user->searchUserEmail()) == 0) {
                $user->createUser();
            } else {
                $_SESSION['msg'] = "<div class=\"alert alert-danger\" role=\"alert\">
                                   E-MAIL já cadastrado
                                </div>";
                $this->data['formReturn'] = $_POST;
            }
        } else {
            $this->data['formReturn'] = $_POST;
        }

        $this->render("User/signin.phtml", "defaultLayout1");
    }

    public function logout()
    {
        session_destroy();
        $this->render("Auth/login.phtml", "layoutAuth");

    }
}

<?php

namespace App\Controllers;

use App\Models\User;
use Config\Controller\Action;

class AuthController extends Action
{
    protected $data = null;

    public function authenticator()
    {
        $this->render("Auth/login.phtml", "layoutAuth");
    }
    public function exec_authenticator()
    {
        $user = new User();
        $user->__set('email', $_POST['email']);
        $user->__set('senha', $_POST['password']);

        if (count($user->authenticate()) == 1) {
            $_SESSION['sId'] = $user->__get('id');
            $_SESSION['sNome'] = $user->__get('nome');
            $_SESSION['sIs_admin'] = $user->__get('is_admin');
            header('location: /');
        } else {
            $_SESSION['msg'] = "<div class=\"alert alert-danger\" role=\"alert\">
                                    Email ou senha incorreto(s). Tente novamente.
                                </div>";
            $this->data['formReturn'] = $_POST;
            $this->render("Auth/login.phtml", "layoutAuth");
        }
    }
}

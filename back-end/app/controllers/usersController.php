<?php

namespace App\Controllers;

use App\Core\App;
use App\Model\User;

class UsersController extends Controller
{
    public function login()
    {
        User::login();
    }

    public function estaLogado()
    {
        if(!User::estaLogado()) {
            return $this->responderJSON(false);
        }
        return $this->responderJSON(true);
    }
}
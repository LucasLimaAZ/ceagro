<?php

namespace App\Controllers;

use App\Core\App;
use App\Models\User;

class UsersController
{
    public function login()
    {
        User::login();
    }

    public function estaLogado()
    {
        session_start();
        if(!isset($_SESSION['logado']) || $_SESSION['logado'] != 1){
            return $this->responderJSON("nao esta logado");
        }else{
            return $this->responderJSON("esta logado");
        }
    }
}
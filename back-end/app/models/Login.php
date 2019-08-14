<?php

namespace App\Models;

use App\Models\Model;

class Login extends Model
{

    public function login()
    {
        session_start();
        $_SESSION['logado'] = 1;
    }

    public function logoff()
    {
        session_destroy();
    }

}
<?php

namespace App\Controllers;

use App\Core\App;
use App\Models\User;

class usersController
{
    public function login()
    {
        session_start();
        $_SESSION['logado'] = 1;
    }
}
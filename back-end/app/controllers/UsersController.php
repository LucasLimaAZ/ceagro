<?php

namespace App\Controllers;

use App\Core\App;
use App\Model\User;

class UsersController extends Controller
{
    public function login()
    {
        $response = User::login();
        return $this->responderJSON($response);
    }

}
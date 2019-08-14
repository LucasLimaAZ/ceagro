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

    public function logout()
    {
        User::logout();
    }

    public function usuarios()
    {
        return $this->responderJSON([
            ["id" => 1,"nome" => "Ruan Vinícius", "login" => "sar3a2e65a4s1", "password" => "d345d"]
        ]);
    }

    public function usuario()
    {
        return $this->responderJSON([ "id" => 1,"nome" => "Ruan Vinícius", "login" => "sar3a2e65a4s1", "password" => "d345d" ]);
    }

}
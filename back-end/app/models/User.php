<?php

namespace App\Model;
use App\Model\Model;
use App\Core\App;

class User
{
    public static function check()
    {
        session_start();
        return (!isset($_SESSION['logado']))? true: false;
    }

    public static function estaLogado()
    {
        session_start();
        if(!isset($_SESSION['logado']) || $_SESSION['logado'] != 1){
            return false;
        }
        else{
            return true;
        }
    }
}
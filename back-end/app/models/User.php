<?php

namespace App\Model;
use App\Model\Model;
use App\Core\App;

class User
{
    public static function check()
    {
        if(!isset($_SESSION['logado'])) {
            session_start();
            return false;
        }
        return true;
    }

    public static function estaLogado()
    {
        if(!isset($_SESSION)) {
            session_start();
        }
        if(!isset($_SESSION['logado']) || $_SESSION['logado'] != 1){
            return false;
        }
        else{
            return true;
        }
    }
}
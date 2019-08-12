<?php

namespace App\Model;
use App\Model\Model;
use App\Core\App;

class User
{
    public static function check()
    {
        session_start();
        if(!isset($_SESSION['logado'])){
            header('Location: ../../sistema/index.php');
        }
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
<?php

namespace App\Model;
use App\Model\Model;
use App\Core\App;

class User
{

    public static function login()
    {
        if(!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['logado'] = 1;
        
        $teste = "abobora";
        return $teste;
    }

    public static function logout()
    {
        $_SESSOIN['logado'] = 0;

        session_destroy();

        header("Location: ../sistema/index.php");
    }

    public static function check()
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
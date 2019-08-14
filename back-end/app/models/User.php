<?php

namespace App\Model;
use App\Model\Model;
use App\Core\App;

class User
{

    public static $table = 'users';

    public static function login()
    {
        if(!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['logado'] = 1;
        return true;
    }

    public static function logout()
    {
        $_SESSION = [];

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
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

    public static function cadastrar($dados)
    {
        User::create($dados, static::$table);
        return $this->responderJSON("Cadastrado com Sucesso!");
    }
}
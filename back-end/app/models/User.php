<?php

namespace App\Models;

class User extends Model
{
    public $id;
    public $nome;
    public $login;
    public $senha;
    /**
     * 1 - Adminsitrador do sistema
     * 2 - Usuário Comum
     * 
     */
    public $tipo;

    public static $table = 'users';

    public static function login($user)
    {
        $usuario = User::autenticate($user['usuario']);
        if($usuario && $usuario->senha == md5($user['senha'])) {
            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['logado']["$usuario->login+$usuario->senha"] = 1;
            return $usuario;
        }
        return toJson("Login ou senha inválidos", 500);
    }

    public static function logout()
    {
        $_SESSION = [];
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }
        header("Location: ../sistema/index.php");
    }

    public static function check()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        $headers = apache_request_headers();
        if(isset($headers['Authorization'])){
            $matches = array();
            preg_match('/Bearer (.*)/', $headers['Authorization'], $matches);
            if(isset($matches[1])){
                $tokens = explode(" ",$matches[1]);
                $tokens[0] = base64_decode($tokens[0]);
                $tokens[1] = base64_decode($tokens[1]);
                if (!isset($_SESSION['logado']["$tokens[0]+$tokens[1]"]) || $_SESSION['logado']["$tokens[0]+$tokens[1]"] != 1) {
                    return false;
                } else {
                    return true;
                }
            }
        } 
        return false;
    }
}

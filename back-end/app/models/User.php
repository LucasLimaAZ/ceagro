<?php

namespace App\Model;
use App\Model\Model;
use App\Core\App;

class User
{
    public static function login()
    {
        header("Location: http://google.com/");
        /*if(isset($_POST['usuario']))
        {
            $dados['usuario'] = $_POST['usuario'];
            $dados['senha'] = $_POST['senha'];
            $resultado = App::get('database')->selectWhere('usuarios',$dados);
            foreach($resultado as $dado)
            {
                $nome = $dado->nome;
            }
            if(!empty($resultado))
            {
                $_SESSION['logado'] = 1;
                $_SESSION['usuario'] = $nome;
                redirect('./');
            }
            else
            {
                redirect('incorreto');
            }
            return $resultado;
        }
    }

    public static function logout()
    {
        session_destroy();
        redirect('loginScreen');
    }

    public static function check()
    {
        if(!isset($_SESSION['usuario']) && $_SESSION['logado'] != 1)
        {
            return redirect('loginScreen');
        }
    }

    public static function cadastrar()
    {
        App::get('database')->insert('usuarios', [
            'nome' => $_POST['nome'],
            'email' => $_POST['email'],
            'sexo' => $_POST['sexo'],
            'nascimento' => $_POST['nascimento'],
            'cpf' => $_POST['cpf'],
            'telefone' => $_POST['telefone'],
            'funcao' => $_POST['funcao'],
            'usuario' => $_POST['usuario'],
            'senha' => $_POST['senha']
        ]);
        return redirect('signUp');*/
    }
}
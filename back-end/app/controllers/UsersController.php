<?php

namespace App\Controllers;

use App\Core\App;
use App\Models\User;

class UsersController extends Controller
{
    public function login($usuario)
    {
        $response = User::login($usuario);
        return $this->responderJSON($response);
    }

    public function logout()
    {
        User::logout();
    }

    public function index()
    {
        $usuarios = User::get();
        return $this->responderJSON($usuarios);
    }

    public function show($id)
    {
        $usuario = User::find(["id", $id]);
        return $this->responderJSON($usuario);
    }

    public function update($usuario)
    {
        $u = User::find(["id", $usuario['id']]);
        $u = $usuario;
        if($usuario['nova_senha']){
            $u['senha'] = md5($usuario['nova_senha']);
        }
        $usuarioId = User::update($u, ["id", $u['id']]);
        $usuario = User::find(["id", $usuarioId]);
        return $this->responderJSON($usuario);
    }

    public function store($usuario)
    {
        if(isset($usuario['senha'])) {
            $usuario['senha'] = md5($usuario['senha']);
        }
        if(isset($usuario['nova_senha'])) {
            $usuario['senha'] = md5($usuario['nova_senha']);
        }
        $usuario = User::create($usuario);
        return $this->responderJSON($usuario);
    }

    public function destroy($usuario)
    {
        $msg = User::delete(['id', $usuario]);
        return $this->responderJson($msg);
    }

}
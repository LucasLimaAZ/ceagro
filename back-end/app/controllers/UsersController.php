<?php

namespace App\Controllers;

use App\Core\App;
use App\Models\User;

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
        $usuarioId = User::update(
            $usuario, ["id", $usuario['usuario']]
        );

        $usuario = User::find(["id", $usuarioId]);
        return $this->responderJSON($usuario);
    }

    public function store($usuario)
    {
        $usuario['senha'] = md5($usuario['senha']);
        $usuario = User::create($usuario);
        return $this->responderJSON($usuario);
    }

    public function destroy($usuario)
    {
        $msg = User::delete(['id', $usuario]);
        return $this->responderJson($msg);
    }

}
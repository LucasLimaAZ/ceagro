<?php

namespace App\Controllers;

use App\Core\App;
use App\Models\Banco;
use App\Models\Cliente;

class ClientesController extends Controller
{

    public function index()
    {
        $clientes = Cliente::get();
        return $this->responderJSON($clientes);
    }

    public function show($id)
    {
        $cliente = Cliente::find(["id", $id]);
        return $this->responderJSON($cliente);
    }

    public function store($cliente)
    {
        $clienteId = Cliente::create($cliente);
        $cliente = Cliente::find(["id", $clienteId]);

        return $this->responderJSON($cliente);
    }

    public function update($cliente)
    {
        $clienteId = Cliente::update(
            $cliente,
            ["id", $cliente['cliente']]
        );

        $cliente = Cliente::find(["id", $clienteId]);

        return $this->responderJSON($cliente);
    }

    public function destroy($cliente)
    {
        $msg = Cliente::delete(['id', $cliente]);
        return $this->responderJson($msg);
    }
}

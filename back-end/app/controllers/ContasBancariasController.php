<?php

namespace App\Controllers;

use App\Core\App;
use App\Models\ContaBancaria;

class ContasBancariasController extends Controller
{
    public function index()
    {
        $contas = ContaBancaria::get();
        return $this->responderJSON($contas);
    }

    public function show($clienteId)
    {
        $contas = ContaBancaria::get(["cliente_id", '=', $clienteId]);
        return $this->responderJSON($contas);
    }

    public function store($conta)
    {
        $contaId = ContaBancaria::create($conta);
        $contas = ContaBancaria::find(["cliente_id", $conta['cliente_id']]);

        return $this->responderJSON($contas);
    }

    public function update($contaBancaria)
    {
        $contaId = ContaBancaria::update(
            $contaBancaria,
            ['id', $contaBancaria['id']]
        );

        $ultimaConta = ContaBancaria::get(["cliente_id", '=', $contaBancaria['cliente_id']]);

        return $this->responderJSON($ultimaConta);
    }

    public function destroy($conta)
    {
        $msg = ContaBancaria::delete(["id", $conta]);
        return $this->responderJSON($msg);
    }
}

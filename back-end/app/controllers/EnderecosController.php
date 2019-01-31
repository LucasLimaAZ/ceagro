<?php

namespace App\Controllers;

use App\Core\App;
use App\Models\Endereco;
use App\Models\Cliente;

class EnderecosController extends Controller
{
    public function index($clienteId = null)
    {
        if ($clienteId) {
            $endereco = Endereco::get(["cliente_id", '=', $clienteId]);
        } else {
            $endereco = Endereco::get();
        }

        return $this->responderJSON($endereco);
    }

    public function store($endereco)
    {
        $enderecoId = Endereco::create($endereco);
        $endereco = Endereco::find(["id", $enderecoId]);
        return $this->responderJSON($endereco);

    }

    public function update($endereco)
    {
        $enderecoId = Endereco::update($endereco, ["id", $endereco['endereco']]);

        $endereco = endereco::find(["id", $enderecoId]);
        return $this->responderJSON($endereco);

    }

    public function destroy($endereco)
    {
        $msg = Endereco::delete(['id', $endereco]);
        return $this->responderJSON($msg);
    }
}

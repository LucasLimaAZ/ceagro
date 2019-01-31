<?php

namespace App\Models;
use App\Models\Cliente;

class Endereco extends Model
{

    public $id;
    public $cliente_id;
    public $cep;
    public $complemento;
    public $bairro;
    public $cidade;
    public $unidade_id;
    public $numero;
    public $estado;
    public $rua;

    public static $table = "enderecos";

    public function cliente()
    {
        return Cliente::find(["id", $this->cliente_id]);
    }
}

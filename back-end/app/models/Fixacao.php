<?php

namespace App\Models;

use App\Models\Model;

class Fixacao extends Model
{

    public $id;
    public $quantidade;
    public $preco;
    public $local_embarque;
    public $data_pagamento;
    public $data_cadastro;
    public $contrato_id;
    public $conta_bancaria_vendedor_id;
    public $contaBancaria;

    public static $table = "fixacoes";

    public function __construct()
    {
        $this->contasBancarias();
    }

    public function contasBancarias()
    {
        return $this->contaBancaria = ContaBancaria::find(["id", $this->conta_bancaria_vendedor_id]);
    }
    public function contrato()
    {
        return Contrato::find(["id", $this->contrato_id]);
    }
}

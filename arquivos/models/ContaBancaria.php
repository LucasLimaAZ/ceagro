<?php

namespace App\Models;

class ContaBancaria extends Model
{
    public $id;
    public $cliente_id;
    public $conta;
    public $agencia;
    public $banco;

    public static $table = "contas_bancarias";
}

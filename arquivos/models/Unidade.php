<?php

namespace App\Models;

class Unidade extends Model
{

    public $id;
    public $cliente_id;
    public $razao_social;
    public $cnpj;
    public $inscricao_estadual;
    public $endereco;

    public $cliente;

    public static $table = "unidades";

    public function __construct()
    {
        $this->endereco();
    }

    public function cliente()
    {
        return $this->cliente = Cliente::find(['id', $this->cliente_id]);
    }

    public function endereco()
    {
        return $this->endereco = Endereco::find(["unidade_id", $this->id]);
    }

    public static function delete($campos = [])
    {
        Endereco::delete(['unidade_id', $campos[1]]);
        return parent::delete($campos);
    }
}
<?php

namespace App\Models;

use App\Models\Model;


class ContratoFuturo extends Model
{
    public $id;
    public $comprador;
    public $vendedor;
    public $contrato_id;

    public static $table = "contratos";

    public function contrato()
    {
        return Contrato::find(['id', $this->contrato_id]);
    }
}
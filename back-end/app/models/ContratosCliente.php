<?php

namespace App\Models;

use App\Models\Model;


class ContratoCliente extends Model
{
    public static $table = "contratos";

    public function contrato()
    {
        return Contrato::get(['vendedor_id', $vendedorId]);
    }
}   
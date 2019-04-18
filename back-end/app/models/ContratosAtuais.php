<?php

namespace App\Models;

use App\Models\Model;


class ContratoAtual extends Model
{
    public static $table = "contratos";

    public function contrato()
    {
        return Contrato::get(['futuro', 0]);
    }
}
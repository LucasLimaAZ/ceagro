<?php

namespace App\Models;

use App\Models\Model;


class Adendo extends Model
{
    public $id;
    public $contrato_id;
    public $descricao;

    public static $table = "adendos";

    public function contrato()
    {
        return Contrato::find(['id', $this->contrato_id]);
    }
}
<?php

namespace App\Controllers;

use App\Core\App;
use App\Models\UnidadeMedida;

class UnidadesMedidasController
{
    public function index()
    {
        $unidades = App::get('db')->selectAll('unidades_medidas', UnidadeMedida::class);
        echo json_encode($unidades);
    }
}

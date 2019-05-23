<?php

namespace App\Controllers;

use App\Models\Cliente;

class FiltrosController
{

    public function index()
    {
        $clientes = Cliente::get();

        require 'app/views/filtro.php';
    }

}
<?php

namespace App\Controllers;

use App\Core\App;
use App\Models\Contato;

class ContatosController
{

    public function index($cliente)
    {
        if (isset($cliente)) {
            $contatos = App::get('db')->selectWhere(
                'contatos',
                ["cliente_id", $cliente]
            );
        } else {
            $contatos = App::get('db')->selectAll('contatos', Contato::class);
        }

        echo json_encode($contatos);
    }

    public function cadastrar($contato)
    {
        $contatoId = App::get('db')->insert('contatos', [
            'telefone' => $contato['telefone'],
            'cliente_id' => $contato['cliente_id'],
            'observacao' => $contato['observacao'],
        ]);

        $ultimoContato = App::get('db')->selectWhere('contatos', ['cliente_id', $contato['cliente_id']]);
        echo json_encode($contato);
    }
}

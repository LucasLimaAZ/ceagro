<?php

namespace App\Controllers;

use App\Models\Cliente;
use App\Models\Endereco;
use App\Models\Unidade;

class AdaptacaoController extends Controller
{

    public function index()
    {
        $clientes = Cliente::get();

        foreach ($clientes as $cliente) {

            /**
             * Criando uma unidade
             */
            $unidade1 = (array)$cliente;
            unset($unidade1['id']);
            $unidade1['cliente_id'] = $cliente->id;
            $unidade = Unidade::create($unidade1);
        }

        /**
         * Buscando todas as unidades.
         */
        $unidades = Unidade::get();
        foreach ($unidades as $unidade) {
            foreach ($unidades as $unidade2) {

                if ($unidade->razao_social === $unidade2->razao_social
                    && $unidade->cliente_id !== $unidade2->cliente_id) {

                    $endereco = Endereco::find(['cliente_id', $unidade2->cliente_id]);

                    $unidade2->cliente_id = $unidade->cliente_id;
                    $u = Unidade::update($unidade2, ["id", $unidade2->id]);

                    if ($endereco) {
                        $endereco->cliente_id = $unidade->cliente_id;
                        $a = Endereco::update($endereco, ['id', $endereco->id]);
                    }
                }
            }

        }
    }
}
<?php

namespace App\Controllers;

use App\Models\Cliente;
use App\Models\Contrato;
use App\Models\Endereco;
use App\Models\Unidade;
use App\Core\App;


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

    public function adaptaAno()
    {
        // $contratosFuturos = Contrato::where(["futuro", 1]);

        $contratosFuturos = App::get('db')->selectWhere(
            'contratos',
            ["futuro", 1]
        );
        $anoAtual = date("Y");

        foreach ($contratosFuturos as $key => $contrato) {
            if(explode("/",$contrato['numero_confirmacao'])[1] == $anoAtual ) {
                $contrato['futuro'] = 0;
                $contratoNovo = Contrato::update(
                    $contrato,
                    ["id", $contrato['id']]
                );
            }
        }

        return $this->responderJson($contratosFuturos);
    }
}
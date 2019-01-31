<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\Fixacao;

class FixacoesController extends Controller
{


    public function index($contrato = null)
    {
        if ($contrato) {
            $fixacoes = Fixacao::get(['contrato_id', '=', $contrato]);
        } else {
            $fixacoes = Fixacao::get();
        }

        return $this->responderJSON($fixacoes);
    }

    public function store($fixacao)
    {
        $a = Fixacao::create($fixacao);
        $fixacoes = Fixacao::get(['contrato_id', '=', $fixacao['contrato_id']]);

        return $this->responderJSON($fixacoes);
    }

    public function update($fixacao)
    {
        Fixacao::update(
            $fixacao,
            ['id', $fixacao['id']]
        );

        $fixacoes = Fixacao::get(['contrato_id', '=', $fixacao['contrato_id']]);
        return $this->responderJSON($fixacoes);
    }

    public function destroy($fixacao)
    {
        $msg = Fixacao::delete(['id', $fixacao]);
        return $this->responderJSON($msg);
    }
}
<?php

namespace App\Controllers;

use App\Models\Adendo;

class AdendosController extends Controller
{

    public function index($contratoId = null)
    {
        if ($contratoId) {
            $adendos = Adendo::get(['contrato_id', '=', $contratoId]);
        } else {
            $adendos = Adendo::get();
        }

        return $this->responderJson($adendos);
    }

    public function store($adendo)
    {
        $adendoId = Adendo::create($adendo);
        $adendos = Adendo::get(['contrato_id', '=', $adendo['contrato_id']]);
        return $this->responderJson($adendos);

    }

    public function destroy($adendo)
    {
        $msg = Adendo::delete(['id', $adendo]);
        return $this->responderJson($msg);
    }
}
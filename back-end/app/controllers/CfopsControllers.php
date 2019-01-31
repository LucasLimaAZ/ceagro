<?php

namespace App\Controllers;
use App\Models\Cfop;

class CfopsController extends Controller {

    public function index()
    {
        $cfops = Cfop::get();
        return $this->responderJSON($cfops);
    }

    public function show($cfop)
    {
        $cfop = Cfop::find(["id", $cfop]);
        return $this->responderJSON($cfop);
    }

    public function update($cfop)
    {
        $cfop = Cfop::update(
            $cfop, ["id", $cfop['cfop']]
        );

        $cfop = Cfop::find(["id", $cfop]);

        return $this->responderJSON($cfop);
    }

    public function destroy($cfop)
    {
        $msg = Cfop::delete(['id',$cfop]);
        return $this->responderJSON($msg);
    }

    public function store($cfop)
    {
        Cfop::create($cfop);
        return $this->responderJSON($exception);
    }
    
}
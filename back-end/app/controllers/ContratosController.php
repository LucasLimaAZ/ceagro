<?php

namespace App\Controllers;

use App\Core\App;
use App\Models\Cliente;
use App\Models\Cfop;
use App\Models\Adendo;
use App\Models\Fixacao;
use App\Models\Contrato;

class ContratosController extends Controller
{
    public function index()
    {
        $contratos = Contrato::get(null,["futuro asc, CAST(SUBSTRING_INDEX(numero_confirmacao, '/', -1) AS UNSIGNED) DESC,CAST(SUBSTRING_INDEX(numero_confirmacao, '/', 1) AS UNSIGNED) DESC"]);
        return $this->responderJSON($contratos);
    }

    public function show($contrato)
    {
        $contrato = Contrato::find(["id", $contrato]);
        return $this->responderJSON($contrato);
    }

    public function store($contrato)
    {
        $contrato['data_cadastro'] = date("Y-m-d");

        try {
            $contratoId = Contrato::create($contrato);

            $ultimoContrato = Contrato::find(["id", $contratoId]);

            return $this->responderJSON($ultimoContrato);

        } catch (\Exception $exception) {
            return $this->responderJSON($exception);
        }
    }

    public function update($contrato)
    {
        try {
            $contratoId = $contrato['contrato'];
            unset($contrato['contrato']);

            Contrato::update( $contrato, ["id", $contratoId] );

            $contrato = Contrato::find(["id", $contratoId]);

            return $this->responderJSON($contrato);

        } catch (\Exception $exception) {
            return $this->responderJSON($exception, 500);
        }
    }

    public function destroy($contrato)
    {
        $msg = Contrato::delete(['id',$contrato]);
        return $this->responderJSON($msg);
    }

    public function contratosFuturos()
    {
        $reflection = new \ReflectionClass("App\Models\Contrato");
        $instance = $reflection->newInstanceWithoutConstructor();
        $futuros = $instance->ultimoFuturo();
        return $this->responderJSON($futuros);
    }

    public function contratosAtuais()
    {
        $reflection = new \ReflectionClass("App\Models\Contrato");
        $instance = $reflection->newInstanceWithoutConstructor();
        $atuais = $instance->ultimoAtual();
        return $this->responderJSON($atuais);
    }

    public function listaContratosAtuais()
    {
        $contrato = Contrato::get(["futuro", 0]);
        return $this->responderJSON($contrato);
    }

    public function listaContratosFuturos()
    {
        $contrato = Contrato::get(["futuro", 1]);
        return $this->responderJSON($contrato);
    }

    public function numeroConfirmacao()
    {
        $reflection = new \ReflectionClass("App\Models\Contrato");
        $instance = $reflection->newInstanceWithoutConstructor();

        $data = date('Y');
        $dataFutura = $data + 1;

        $futuro = $instance->ultimoFuturo() . "/" . $dataFutura;
        $atual = $instance->ultimoAtual() . "/" . $data;

        return $this->responderJSON([$atual, $futuro]);
    }

    public function dados()
    {
        $contratos = Contrato::get();
        $compradoresIds = [];

        foreach ($contratos as $contrato) {
            $compradoresIds[] = $contrato->comprador_id;
        }

        $num = count($compradoresIds);

        $compradores = array_map(
            function ($val) use ($num) {
                return array('count' => $val, 'avg' => round($val / $num * 100, 1));
            },
            array_count_values($compradoresIds)
        );

        foreach ($compradores as $k => &$item) {
            $comprador = Cliente::find(['id', $k]);
            $item['cliente'] = ($comprador->nome_fantasia) ? $comprador->nome_fantasia : $comprador->cnpj;
        }

        return $this->responderJSON($compradores);
    }

    public function dados2()
    {
        $contratos = Contrato::get();
        $vendedoresIds = [];

        foreach ($contratos as $contrato) {
            $vendedoresIds[] = $contrato->vendedor_id;
        }

        $num = count($vendedoresIds);
        $vendedores = array_map(
            function ($val) use ($num) {
                return array('count' => $val, 'avg' => round($val / $num * 100, 1));
            },
            array_count_values($vendedoresIds)
        );

        foreach ($vendedores as $k => &$item) {
            $vendedor = Cliente::find(['id', $k]);
            $item['cliente'] = ($vendedor->nome_fantasia) ? $vendedor->nome_fantasia : $vendedor->cnpj;
        }

        return $this->responderJSON($vendedores);
    }
}

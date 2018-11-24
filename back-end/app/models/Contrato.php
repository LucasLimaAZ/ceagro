<?php

namespace App\Models;

use App\Core\App;
use App\Models\Cliente;
use App\Models\Produto;

class Contrato extends Model
{
    public $id;
    public $numero_confirmacao;
    public $vendedor_id;
    public $comprador_id;
    public $produto_id;
    public $unidade_medida_id;
    public $safra;
    public $quantidade;
    public $descricao;
    public $pagamento;
    public $tipo_embarque;
    public $local;
    public $data_embarque;
    public $peso_qualidade;
    public $cfop;
    public $solicitacao_cotas;
    public $carregamento;
    public $assinatura_vendedor;
    public $assinatura_comprador;
    public $observacao;
    public $comissao;
    public $data_cadastro;
    public $valor_contrato;
    public $peso_total;

    public $adendos;
    public $comprador;
    public $vendedor;
    public $produto;

    protected static $table = "contratos";

    public function __construct()
    {
        $this->comprador();
        $this->vendedor();
        $this->produto();
        $this->adendos();
    }

    public function comprador()
    {
        return $this->comprador = Cliente::find(["id", $this->comprador_id]);
    }
    public function vendedor()
    {
        return $this->vendedor = Cliente::find(["id", $this->vendedor_id]);
    }
    public function produto()
    {
        return $this->produto = Produto::find(["id", $this->produto_id]);
    }
    public function adendos()
    {
        return $this->adendos = Adendo::get(['contrato_id', $this->id]);
    }
}

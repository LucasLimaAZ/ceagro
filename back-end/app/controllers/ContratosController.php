<?php

namespace App\Controllers;

use App\Core\App;
use App\Models\Contrato;

class ContratosController
{
    public function index($limite = 50)
    {
        $contratos = App::get('db')->selectTo("contratos", Contrato::class, null, $limite);
        echo json_encode($contratos);
    }

    public function show($contrato)
    {
        $contrato = Contrato::find(["id", $contrato]);
        echo json_encode($contrato);
    }

    public function cadastrar($contrato)
    {
        try {
            $contratoId = App::get('db')->insert('contratos', [
                'vendedor_id' => $contrato['vendedor_id'],
                'produto_id' => $contrato['produto_id'],
                'tipo_embarque' => $contrato['tipo_embarque'] ?? "",
                'comprador_id' => $contrato['comprador_id'],
                'codigo' => $contrato['codigo'] ?? "",
                'assinatura_vendedor' => $contrato['assinatura_vendedor'] ?? "",
                'assinatura_comprador' => $contrato['assinatura_comprador'] ?? "",
                'quantidade_descricao' => $contrato['quantidade_descricao'] ?? "",
                'preco_texto' => $contrato['preco_texto'] ?? "",
                'pagamento_texto' => $contrato['pagamento_texto'] ?? "",
                'comissao' => $contrato['comissao'] ?? "",
                'peso_qualidade' => $contrato['peso_qualidade'] ?? "",
                'peso_total' => $contrato['peso_total'] ?? "",
                'unidade_medida_id' => $contrato['unidade_medida_id'],
                'valor_contrato' => $contrato['valor_contrato'] ?? "",
                'data_cadastro' => $contrato['data_cadastro'] ?? "",
                'safra' => $contrato['safra'] ?? "",
            ]);

            $ultimoContrato = Contrato::find(["id", $contratoId]);

            echo json_encode($ultimoContrato);

        } catch (\Exception $exception) {
            echo json_encode($exception);
        }
    }

    public function update($contrato)
    {
        try {
            $contratoId = App::get('db')->update('contratos', [
                'vendedor_id' => $contrato['vendedor_id'],
                'produto_id' => $contrato['produto_id'],
                'tipo_embarque' => $contrato['tipo_embarque'] ?? "",
                'comprador_id' => $contrato['comprador_id'],
                'codigo' => $contrato['codigo'] ?? "",
                'assinatura_vendedor' => $contrato['assinatura_vendedor'] ?? "",
                'assinatura_comprador' => $contrato['assinatura_comprador'] ?? "",
                'quantidade_descricao' => $contrato['quantidade_descricao'] ?? "",
                'preco_texto' => $contrato['preco_texto'] ?? "",
                'pagamento_texto' => $contrato['pagamento_texto'] ?? "",
                'comissao' => $contrato['comissao'] ?? "",
                'peso_qualidade' => $contrato['peso_qualidade'] ?? "",
                'peso_total' => $contrato['peso_total'] ?? "",
                'unidade_medida_id' => $contrato['unidade_medida_id'],
                'valor_contrato' => $contrato['valor_contrato'] ?? "",
                'data_cadastro' => $contrato['data_cadastro'] ?? "",
                'safra' => $contrato['safra'] ?? "",
            ],
                ["id", $contrato['contrato']]);

            $contrato = App::get('db')->selectWhere(
                'contratos',
                ["id", $contratoId]
            )[0];

            echo json_encode($contrato);

        } catch (\Exception $exception) {
            echo json_encode($exception);
        }
    }
}

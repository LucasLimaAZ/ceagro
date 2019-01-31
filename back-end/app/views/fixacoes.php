<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fixações</title>
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 12px !important;
        text-align: justify;
    }
    body {
        margin-top: 2.5cm;
        margin-bottom: 2.5cm;
        margin-left: 3cm;
        margin-right: 3cm;
    }

    .data, .assinatura {
        float: right;
    }
    .assinatura {
        margin-right: 10%;
    }
    .confirmacao,
    .vendedor {
        margin-top: 3%;
    }
    .nome {
        float: left;
        background-color: red
    }
    .comprador {
        margin-top: 2%;
    }
    .produto {
        margin-top: 2%;
    }
    .tdproduto {
        width: 400px;
    }
    .paddingTop20 {
        padding-top: 10px;
    }
    .linha {
        padding-top: 50px;
    }
    .center{
        padding-left:33.33%;
    }
    .cnpjCeagro{
        padding-left:60%;
    }
</style>

<body>
<header>
        <div class="log">
            <img src="public/img/logo.png" alt="">
        </div>
        <div class="data"> Porto Alegre
            <?= $data ?>
        </div>
    </header>
    <section>
        <div class="confirmacao">
            <span>Confirmação número: <strong><?= $fixacoes[0]->contrato()->numero_confirmacao ?></strong></span>
        </div>
    </section>
    <section>
        <div class="vendedor">
            <table>
                <tr>
                    <td colspan="2">Vendedor:
                        <?= $fixacoes[0]->contrato()->unidadeVendedor->razao_social ?></td>
                    <td>A/C:
                        <?= $fixacoes[0]->contrato()->assinatura_vendedor ?></td>
                </tr>
                <tr>
                    <td>
                        Rua <?= ($fixacoes[0]->contrato()->unidadeVendedor->endereco->rua && strlen($fixacoes[0]->contrato()->unidadeVendedor->endereco->rua) > 0) ? "{$fixacoes[0]->contrato()->unidadeVendedor->endereco->rua}, " : 'não cadastrada, ' ?>
                        <?= ($fixacoes[0]->contrato()->unidadeVendedor->endereco->numero && strlen($fixacoes[0]->contrato()->unidadeVendedor->endereco->numero) > 0) ? "{$fixacoes[0]->contrato()->unidadeVendedor->endereco->numero}, " : ' -,  ' ?>
                    
                        <?= ($fixacoes[0]->contrato()->unidadeVendedor->endereco->cidade && strlen($fixacoes[0]->contrato()->unidadeVendedor->endereco->cidade)) ? "{$fixacoes[0]->contrato()->unidadeVendedor->endereco->cidade} - " : "" ?>
                            <?= ($fixacoes[0]->contrato()->unidadeVendedor->endereco->estado) ? $fixacoes[0]->contrato()->unidadeVendedor->endereco->estado : " - " . $fixacoes[0]->contrato()->unidadeVendedor->endereco->estado ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        CNPJ:
                        <?= $fixacoes[0]->contrato()->unidadeVendedor->cnpj ?>
                    </td>
                </tr>
                <tr>
                    <td>
                    Inscrição Estadual:
                        <?= ($fixacoes[0]->contrato()->unidadeVendedor->inscricao_estadual && strlen($fixacoes[0]->contrato()->unidadeVendedor->inscricao_estadual) > 0) ? $fixacoes[0]->contrato()->unidadeVendedor->inscricao_estadual : "-" ?>
                    </td>
                </tr>
            </table>
        </div>
    </section>
    <section>
        <div class="comprador">
            <table>
                <tr>
                    <td colspan="2">Comprador:
                        <?= $fixacoes[0]->contrato()->unidadeComprador()->razao_social ?></td>
                    <td>A/C:
                        <?= $fixacoes[0]->contrato()->assinatura_comprador ?></td>
                </tr>
                <tr>
                    <td>
                        Rua <?= ($fixacoes[0]->contrato()->unidadeComprador->endereco->rua && strlen($fixacoes[0]->contrato()->unidadeComprador->endereco->rua) > 0) ? "{$fixacoes[0]->contrato()->unidadeComprador->endereco->rua}, " : 'não cadastrada, ' ?>
                        <?= ($fixacoes[0]->contrato()->unidadeComprador->endereco->numero && strlen($fixacoes[0]->contrato()->unidadeComprador->endereco->numero) > 0) ? "{$fixacoes[0]->contrato()->unidadeComprador->endereco->numero}, " : ' -,  ' ?>
                    
                        <?= ($fixacoes[0]->contrato()->unidadeComprador->endereco->cidade && strlen($fixacoes[0]->contrato()->unidadeComprador->endereco->cidade)) ? "{$fixacoes[0]->contrato()->unidadeComprador->endereco->cidade} - " : "" ?>
                            <?= ($fixacoes[0]->contrato()->unidadeComprador->endereco->estado) ? $fixacoes[0]->contrato()->unidadeComprador->endereco->estado : " - " . $fixacoes[0]->contrato()->unidadeComprador->endereco->estado ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        CNPJ:
                        <?= $fixacoes[0]->contrato()->unidadeComprador->cnpj ?>
                    </td>
                </tr>
                <tr>
                    <td>
                    Inscrição Estadual:
                        <?= ($fixacoes[0]->contrato()->unidadeComprador->inscricao_estadual && strlen($fixacoes[0]->contrato()->unidadeComprador->inscricao_estadual) > 0) ? $fixacoes[0]->contrato()->unidadeComprador->inscricao_estadual : "-" ?>
                    </td>
                </tr>
            </table>
        </div>
    </section>
    <section style="margin-top: 20px">
        <?php foreach($fixacoes as $fixacao): ?>
        <table style="border: 1px black solid; width: 100%; margin-top: 3px;">
            <tr>
                <td class="padding20">Quantidade: <?= $fixacao->quantidade ?></td>
            </tr>
            <tr>
                <td class="padding20">Preço: <?= $fixacao->preco ?></td>
            </tr>
            <tr>
                <td class="padding20">Local de embarque: <?= $fixacao->local_embarque ?></td>
            </tr>
            <tr>
                <td class="padding20">Contas bancárias: <?= 'Banco:'. $fixacao->contasBancarias()->banco .'- agência:'. $fixacao->contasBancarias()->agencia .'- conta:'.$fixacao->contasBancarias()->conta ?></td>
            </tr>
            <tr>
                <td class="padding20">Data pagamento: <?= $fixacao->data_pagamento ?></td>
            </tr>
        </table>
        <?php endforeach ?>
    </section>
</body>

</html>
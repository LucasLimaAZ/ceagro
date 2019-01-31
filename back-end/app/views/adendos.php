<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Adendos</title>
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
            <span>Confirmação número: <strong><?= $adendos[0]->contrato()->numero_confirmacao ?></strong></span>
        </div>
    </section>
    <section>
        <div class="vendedor">
            <table>
                <tr>
                    <td colspan="2">Vendedor:
                        <?= $adendos[0]->contrato()->unidadeVendedor->razao_social ?></td>
                    <td>A/C:
                        <?= $adendos[0]->contrato()->assinatura_vendedor ?></td>
                </tr>
                <tr>
                    <td>
                        Rua <?= ($adendos[0]->contrato()->unidadeVendedor->endereco->rua && strlen($adendos[0]->contrato()->unidadeVendedor->endereco->rua) > 0) ? "{$adendos[0]->contrato()->unidadeVendedor->endereco->rua}, " : 'não cadastrada, ' ?>
                        <?= ($adendos[0]->contrato()->unidadeVendedor->endereco->numero && strlen($adendos[0]->contrato()->unidadeVendedor->endereco->numero) > 0) ? "{$adendos[0]->contrato()->unidadeVendedor->endereco->numero}, " : ' -,  ' ?>
                    
                        <?= ($adendos[0]->contrato()->unidadeVendedor->endereco->cidade && strlen($adendos[0]->contrato()->unidadeVendedor->endereco->cidade)) ? "{$adendos[0]->contrato()->unidadeVendedor->endereco->cidade} - " : "" ?>
                            <?= ($adendos[0]->contrato()->unidadeVendedor->endereco->estado) ? $adendos[0]->contrato()->unidadeVendedor->endereco->estado : " - " . $adendos[0]->contrato()->unidadeVendedor->endereco->estado ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        CNPJ:
                        <?= $adendos[0]->contrato()->unidadeVendedor->cnpj ?>
                    </td>
                </tr>
                <tr>
                    <td>
                    Inscrição Estadual:
                        <?= ($adendos[0]->contrato()->unidadeVendedor->inscricao_estadual && strlen($adendos[0]->contrato()->unidadeVendedor->inscricao_estadual) > 0) ? $adendos[0]->contrato()->unidadeVendedor->inscricao_estadual : "-" ?>
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
                        <?= $adendos[0]->contrato()->unidadeComprador()->razao_social ?></td>
                    <td>A/C:
                        <?= $adendos[0]->contrato()->assinatura_comprador ?></td>
                </tr>
                <tr>
                    <td>
                        Rua <?= ($adendos[0]->contrato()->unidadeComprador->endereco->rua && strlen($adendos[0]->contrato()->unidadeComprador->endereco->rua) > 0) ? "{$adendos[0]->contrato()->unidadeComprador->endereco->rua}, " : 'não cadastrada, ' ?>
                        <?= ($adendos[0]->contrato()->unidadeComprador->endereco->numero && strlen($adendos[0]->contrato()->unidadeComprador->endereco->numero) > 0) ? "{$adendos[0]->contrato()->unidadeComprador->endereco->numero}, " : ' -,  ' ?>
                    
                        <?= ($adendos[0]->contrato()->unidadeComprador->endereco->cidade && strlen($adendos[0]->contrato()->unidadeComprador->endereco->cidade)) ? "{$adendos[0]->contrato()->unidadeComprador->endereco->cidade} - " : "" ?>
                            <?= ($adendos[0]->contrato()->unidadeComprador->endereco->estado) ? $adendos[0]->contrato()->unidadeComprador->endereco->estado : " - " . $adendos[0]->contrato()->unidadeComprador->endereco->estado ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        CNPJ:
                        <?= $adendos[0]->contrato()->unidadeComprador->cnpj ?>
                    </td>
                </tr>
                <tr>
                    <td>
                    Inscrição Estadual:
                        <?= ($adendos[0]->contrato()->unidadeComprador->inscricao_estadual && strlen($adendos[0]->contrato()->unidadeComprador->inscricao_estadual) > 0) ? $adendos[0]->contrato()->unidadeComprador->inscricao_estadual : "-" ?>
                    </td>
                </tr>
            </table>
        </div>
    </section>
    <section>
        <?php foreach ($adendos as $adendo):?>
        <table style="border: 1px black solid; width: 100%; margin-top: 3px;">
            <tr>
                <td class="paddingTop20" ><strong>Descrição</strong>: <?=$adendo->descricao; ?></td>
            </tr>
        </table>
        <?php endforeach?>
    </section>
</body>

</html>
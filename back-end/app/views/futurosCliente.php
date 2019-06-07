<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contratos Futuros</title>
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 10px !important;
    }
    body {
        margin-top: 2.5cm !important;
        margin-bottom: 2.5cm !important;
        margin-left: 3cm !important;
        margin-right: 3cm !important;
    }

    .data, .assinatura {
        float: right;
    }
    
    .paddingTop20 {
        padding-top: 10px;
    }
    .tabela{
        margin-top:5%;
    }
    
    .tabela tr:nth-child(even) {
        background-color: #d1d1d1;
    }

    .title{
        margin-top:7%;
        text-align:center;
    }

    table{
        width: 15cm;
        border-collapse: collapse;
        border: 1px solid grey;
        text-align: center !important;
    }

    td, th {
        border: 1px solid grey;
        padding:3px;
    }

    .vendedor {
        margin-top: 3%;
        word-break: break-all;
    }

    .valor {
        width:2cm;
    }
    .futuro {
        width:1cm;
    }
    .nmro {
        width:2cm;
    }

    .all {
        width:2cm;
    }

    .produtos th {
        width:2cm;
    }
    .produtos th+th {
        width:1cm;
    }
    .produtos th+th+th {
        width:3cm !important;
    }

    
    
</style>

<body>
    <header>
        <div class="log">
            <img src="public/img/logo.png" alt="">
        </div>
        <div class="data">
        <strong> Porto Alegre, 
            <?php
                setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
                date_default_timezone_set('America/Sao_Paulo');
                $data = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));
                echo date("d-m-Y", $data);
            ?>
            </strong>
        </div>
    </header>
    
    <section>
        <div class="title">PRODUTOS MAIS VENDIDO</div>
            <table class="tabela produtos">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Quantidade</th>
                        <th>Valor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($produtosVendidos as $key => $contrato): ?>
                        <tr>
                            <td ><?=$contrato->nome;?></td>
                            <td><?=$contrato->incidencia;?></td>
                            <td><?=$contrato->preco;?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
    </section>
    <section>
        <div class="title">VENDEDOR (Futuro)</div>
        <div class="tabela">
            <table>
                <thead>
                    <tr>
                        <th>Nº</th>
                        <th>Vendedor</th>
                        <th>Comprador</th>
                        <th>Produto</th>
                        <th>Data Inicial</th>
                        <th>Data Final</th>
                        <th>Valor</th>
                        <th>Pagamento</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($contratosVendedor as $contrato): ?>
                        <?php if($contrato->futuro): ?>
                            <tr>
                                <td><?=$contrato->numero_confirmacao;?></td>
                                <td><?=$contrato->unidadeVendedor()->razao_social;?></td>
                                <td><?=$contrato->unidadeComprador()->razao_social;?></td>
                                <td><?=$contrato->produto->nome;?></td>
                                <td><?=$contrato->data_embarque_inicial;?></td>
                                <td><?=$contrato->data_embarque_final;?></td>
                                <td><?=$contrato->preco;?></td>
                                <td><?=$contrato->pagamento;?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </section>
    <section>
        <div class="title">COMPRADOR (Futuro)</div>
        <div class="tabela">
            <table>
                <thead>
                    <tr>
                        <th>Nº </th>
                        <th>Vendedor</th>
                        <th>Comprador</th>
                        <th>Produto</th>
                        <th>Data Inicial</th>
                        <th>Data Final</th>
                        <th >Valor</th>
                        <th >Pagamento</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($contratosComprador as $contrato): ?>
                        <?php if($contrato->futuro): ?>
                        <tr>
                            <td><?=$contrato->numero_confirmacao;?></td>
                            <td><?=$contrato->unidadeVendedor()->razao_social;?></td>
                            <td><?=$contrato->unidadeComprador()->razao_social;?></td>
                            <td><?=$contrato->produto->nome;?></td>
                            <td><?=$contrato->data_embarque_inicial;?></td>
                            <td><?=$contrato->data_embarque_final;?></td>
                            <td><?=$contrato->preco;?></td>
                            <td><?=$contrato->pagamento;?></td>
                        </tr>
                        <?php endif; ?>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </section>
</body>

</html>
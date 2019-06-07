<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contratos</title>
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
    
    .paddingTop20 {
        padding-top: 10px;
    }
    .tabela{
        margin-top:5%;
    }
    
    tr:nth-child(even) {
        background-color: #d1d1d1;
    }

    tr{
        border: 1px solid grey;
    }

    .title{
        margin-top:7%;
        text-align:center;
    }

    table{
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
        border: 1px solid grey;
    }

    td {
        text-align: left;
        padding: 5px;
        font-size: 10px !important;
        border-bottom: 1px solid grey;
    }

    th{
        text-align:center;
        border-bottom: 1px solid grey;
        padding:5px;
    }
    
</style>

<body>
    <header>
        <div class="log">
            <img src="public/img/logo.png" alt="">
        </div>
        <div class="data"><strong> Porto Alegre, 
        <?php
            setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
            date_default_timezone_set('America/Sao_Paulo');
            $data = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));
            echo date("d-m-Y", $data);
            //echo strftime('%d de %B de %Y', strtotime());
        ?></strong>
        </div>
    </header>
    <section>
            <?php
                $nVendedor = 0;
                foreach($vendedor as $contrato_vendedor){
                $nVendedor++;
                }
            ?>
        <div class="title">CONTRATOS ONDE O CLIENTE FOI O VENDEDOR (<?=$nVendedor;?>)</div>
        <div class="tabela">
        <table>
            <thead>
                <tr>
                    <th>Nº Confimação</th>
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
                <?php
                $nVendedor = 0;
                foreach($vendedor as $contrato_vendedor){
                $nVendedor++;
                ?>

                <tr>

                    <td><?=$contrato_vendedor->numero_confirmacao;?></td>
                    <td><?=$contrato_vendedor->unidadeVendedor()->razao_social;?></td>
                    <td><?=$contrato_vendedor->unidadeComprador()->razao_social;?></td>
                    <td><?=$contrato_vendedor->produto->nome;?></td>
                    <td><?=$contrato_vendedor->data_embarque_inicial;?></td>
                    <td><?=$contrato_vendedor->data_embarque_final;?></td>
                    <td><?=$contrato_vendedor->preco;?></td>
                    <td><?=$contrato_vendedor->pagamento;?></td>

                </tr>
                
                <?php

                }

                ?>
            </tbody>
        </table>
        </div>
    </section>
    <section>
            <?php
                $nComprador = 0;
                foreach($comprador as $contrato_comprador){
                $nComprador++;
                }
            ?>
        <div class="title">CONTRATOS ONDE O CLIENTE FOI O COMPRADOR (<?=$nComprador;?>)</div>
        <div class="tabela">
        <table>
            <thead>
                <tr>
                    <th>Nº Confimação</th>
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
                <?php

                foreach($comprador as $contrato_comprador){

                ?>

                <tr>

                    <td><?=$contrato_comprador->numero_confirmacao;?></td>
                    <td><?=$contrato_comprador->unidadeVendedor()->razao_social;?></td>
                    <td><?=$contrato_comprador->unidadeComprador()->razao_social;?></td>
                    <td><?=$contrato_comprador->produto->nome;?></td>
                    <td><?=$contrato_comprador->data_embarque_inicial;?></td>
                    <td><?=$contrato_comprador->data_embarque_final;?></td>
                    <td><?=$contrato_comprador->preco;?></td>
                    <td><?=$contrato_comprador->pagamento;?></td>

                </tr>
                
                <?php

                }

                ?>
            </tbody>
        </table>
        </div>
    </section>
</body>

</html>
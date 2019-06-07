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

    .title{
        margin-top:7%;
        text-align:center;
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

    .nContratos{
        float:left;
        margin-top:2%;
    }
    .cnpjCeagro{
        padding-left:63%;
    }
    .footerCeagro{
        padding-left:48%;
    }

    .footer{
        position:fixed;
        bottom:75px !important;
    }
    
    
</style>

<body>
    <header>
    <?php
    $nContratos = 0;
    foreach ($contrato as $campo){
        $nContratos++;
    }
    ?>
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
        <div class="nContratos">
        Você tem <b><?=$nContratos;?></b> contratos futuros.
        </div>
    </header>
    <section>
        <div class="title">CONTRATOS FUTUROS</div>
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

                foreach($contrato as $campo){

                ?>

                <tr>

                    <td><?=$campo->numero_confirmacao;?></td>
                    <td><?=$campo->unidadeVendedor()->razao_social;?></td>
                    <td><?=$campo->unidadeComprador()->razao_social;?></td>
                    <td><?=$campo->produto->nome;?></td>
                    <td><?=$campo->data_embarque_inicial;?></td>
                    <td><?=$campo->data_embarque_inicial;?></td>
                    <td><?=$campo->preco;?></td>
                    <td><?=$campo->pagamento;?></td>

                </tr>

                <?php

                }

                ?>
            </tbody>
            <div class="footer">
                <div>
                    <div class="footerCeagro"><pre>CEAGRO CORRETORA DE MERCADORIAS LTDA</pre></div>
                </div> 
                <div>
                    <div class="cnpjCeagro"><pre>90.880.204/0001-57</pre></div>
                </div>
            </div>
        </table>
        </div>
    </section>
</body>

</html>
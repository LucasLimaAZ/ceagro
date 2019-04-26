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

    .center{
        padding-left:25%;
    }
    .cnpjCeagro{
        margin-top:5%;
        font-weight: bold;
        padding-left:40%;
    }

    .contador{
        float:left;
        font-weight: bold;
        margin-top:5%;
    }
    
</style>

<body>
    <header>
        <div class="log">
            <img src="public/img/logo.png" alt="">
        </div>
        <div class="data">
        <div class="contador">
            <?php
            $nContratos = 0;
            foreach($contrato as $campo){$nContratos++;}
            echo "Você tem <u>$nContratos</u> contratos atuais.";
            ?>
        </div>
        <strong> Porto Alegre, 
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
        <div class="title">CONTRATOS ATUAIS</div>
        <div class="tabela">
        <table>
            <thead>
                <tr>
                    <th>Nº Confimação</th>
                    <th>Vendedor</th>
                    <th>Comprador</th>
                    <th>Produto</th>
                    <th>Valor</th>
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
                    <td><?=$campo->preco;?></td>

                </tr>
                
                <?php

                }

                ?>
            </tbody>
            <div>
                <div class="center"><pre>CEAGRO CORRETORA DE MERCADORIAS LTDA</pre></div>
            </div>
            <div>
                <div class="cnpjCeagro"><pre>90.880.204/0001-57</pre></div>
            </div>
        </table>
        </div>
    </section>
</body>

</html>
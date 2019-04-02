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
    td{
        border:1px solid;
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
        <div class="tabela">
        <table>
            <thead>
                <tr>
                    <td>CONTRATOS FUTUROS</td>
                </tr>
                <tr>
                    <td>Comprador</td>
                    <td>Vendedor</td>
                    <td>Produto</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?=$contrato->assinatura_comprador;?></td>
                    <td><?=$contrato->assinatura_vendedor;?></td>
                    <td><?=$contrato->assinatura_vendedor;?></td>
                </tr>
            </tbody>
        </table>
        </div>
    </section>
</body>

</html>
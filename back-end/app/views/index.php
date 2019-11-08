<!DOCTYPE html>
<html lang="en">

<head>
<link rel="stylesheet" type="text/css" href="style.css" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Contrato</title>
</head>
<style>

    *{
        margin: 0;
        padding: 0;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 12px !important;
        text-align: justify;
        display:block;
        page-break-inside:avoid;
    }
    
    body {
        margin-top: 1cm;
        margin-bottom: 1cm;
        margin-left: 2cm;
        margin-right: 2cm;
    }
    table {
        width: 660px !important;
    }

    .data {float:right}
    .data,
    .vendedor {
        margin-top: 3%;
        word-break: break-all;
    }
    .nome {
        float: left;
        background-color: red
    }
    .comprador {
        margin-top: 10px;
        margin-bottom:1%;
    }
    .produto {
        margin-top: 1%;
    }
    .tdproduto {
        width: 600px;
    }
    .paddingTop20 {
        padding-top: 8px;
    }
    .linha {
        padding-top: 20px;
    }
    .center{
        text-align:center !important;
    }
    .cnpjCeagro{
        padding-left:60%;
    }
    .ac{
        width:30%;
        float:right;
        text-align:left;
        vertical-align: top;
    }
    .halfSize{
        text-align:left;
        width: 30rem;
        word-wrap: break-word !important;
    }
    .float-right{
        float:right !important;
    }
    .produto1{
        width:49%;
        margin-top:10px;
    }
    .safra{
        width:30%;
        float:right;
    }
    .quantidade{
        width:49%;
    }
    .unidade{
        width:30%;
        float:right;
    }
    .assinatura_comprador{
        width:49%;
        float:right;
    }
    .assinatura_vendedor{
        width:49%;
    }
    .assinatura_vendedor,.assinatura_comprador td{
        text-align:center;
    }
    .assinatura_ceagro{
        padding-top:30px;
        text-align:center !important;
    }
    .ass{
        page-break-after: avoid !important;
        page-break-before: avoid !important;
        page-break-inside: avoid !important;
        display:block;
        padding-top:30px !important;
    }
    .inline{
        display:inline-block;
        padding-bottom:-2px;
    }

</style>

<body>
<header>
    <div class="log">
        <img src="public/img/logo.png" alt="">
    </div>
    <div style="float:right;" class="data"><strong> Porto Alegre, 
    <?php
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');
        echo utf8_encode(strftime('%d de %B de %Y', strtotime($contrato->data_cadastro)));
    ?></strong>
    </div>
</header>

<section>
    <div class="confirmacao">
        <span>Confirmação número: <b class="inline"><?= $contrato->numero_confirmacao ?></b></span>
    </div>
</section>
<section>
    <div class="vendedor">
        <table>
            <tr>
                <td class="ac">
                    <b class="inline">A/C:</b>
                    <?= $contrato->assinatura_vendedor; ?>
                </td>
                <td class="halfSize">
                    <b class="inline">Vendedor:</b>
                    <?= $contrato->unidadeVendedor()->razao_social ?>
                </td>         
            </tr>
            
            <tr>
                <td>
                    <?= ($contrato->unidadeVendedor->endereco->rua && strlen($contrato->unidadeVendedor->endereco->rua) > 0) ? "{$contrato->unidadeVendedor->endereco->rua}, " : 'Não cadastrada, ' ?>
                    <?= ($contrato->unidadeVendedor->endereco->numero && strlen($contrato->unidadeVendedor->endereco->numero) > 0) ? "{$contrato->unidadeVendedor->endereco->numero}, " : ' -,  ' ?>
                
                    <?= ($contrato->unidadeVendedor->endereco->cidade && strlen($contrato->unidadeVendedor->endereco->cidade)) ? "{$contrato->unidadeVendedor->endereco->cidade} - " : "" ?>
                        <?= ($contrato->unidadeVendedor->endereco->estado) ? $contrato->unidadeVendedor->endereco->estado : " - " . $contrato->unidadeVendedor->endereco->estado ?>
                </td>
            </tr>
            <tr>
                <td>
                    CNPJ/CPF:
                    <?= $contrato->unidadeVendedor->cnpj ?>
                </td>
            </tr>
            <tr>
                <td >
                Inscrição Estadual:
                    <?= ($contrato->unidadeVendedor->inscricao_estadual && strlen($contrato->unidadeVendedor->inscricao_estadual) > 0) ? $contrato->unidadeVendedor->inscricao_estadual : "-" ?>
                </td>
                
            </tr>
        </table>
    </div>
</section>
<section>
    <div class="comprador">
        <table>
            <tr>
            <td class="ac"> <b class="inline">A/C:</b>
                <?= $contrato->assinatura_comprador ?></td>
                <td class="halfSize"><b class="inline">Comprador:</b>
                    <?= $contrato->unidadeComprador->razao_social?></td>
                    
            </tr>
            
            <tr>
                <td>
                    <?= ($contrato->unidadeComprador->endereco->rua && strlen($contrato->unidadeComprador->endereco->rua) > 0) ? "{$contrato->unidadeComprador->endereco->rua}, " : 'Não cadastrada, ' ?>
                    <?= ($contrato->unidadeComprador->endereco->numero && strlen($contrato->unidadeComprador->endereco->numero) > 0) ? "{$contrato->unidadeComprador->endereco->numero}, " : ' -,  ' ?>
                
                    <?= ($contrato->unidadeComprador->endereco->cidade && strlen($contrato->unidadeComprador->endereco->cidade)) ? "{$contrato->unidadeComprador->endereco->cidade} - " : "" ?>
                        <?= ($contrato->unidadeComprador->endereco->estado) ? $contrato->unidadeComprador->endereco->estado : " - " . $contrato->unidadeComprador->endereco->estado ?>
                </td>
            </tr>
            <tr>
                <td>
                    CNPJ/CPF:
                    <?= $contrato->unidadeComprador->cnpj ?>
                </td>
            </tr>
            <tr>
                <td >
                Inscrição Estadual:
                    <?= ($contrato->unidadeComprador->inscricao_estadual && strlen($contrato->unidadeComprador->inscricao_estadual) > 0) ? $contrato->unidadeComprador->inscricao_estadual : "-" ?>
                </td>
                
            </tr>
        </table>
    </div>
</section>

<div class="breaker">
<section>
        <table  >
            <tr>
                <td class="safra" colspan="2">
                <b class="inline">Safra:</b> <?= ($contrato->safra)?$contrato->safra : "Nenhum" ?>
                </td>
                <td class="produto1">
                <b class="inline"> Produto:</b> <?= $contrato->produto->nome ?>
                </td>
            </tr>
            <tr>
                <td class="paddingTop20 unidade"><b class="inline">Unidade:</b>
                    <?= $contrato->unidade()->titulo ?>
                </td>
                <td class="paddingTop20 quantidade"><b class="inline">Quantidade:</b>
                    <?= $contrato->quantidade ?>
                </td>
            </tr>
            <tr>
                <td class="paddingTop20" colspan="3"> <b class="inline">Descrição:</b>
                <?= $contrato->produto()->descricao ?>
                </td>
            </tr>
            <tr>
                <td class="paddingTop20" colspan="3">
                <b class="inline"> Preço:</b>
                    <?= $contrato->preco ?>. <?= $contrato->tipo_embarque ?>, <?= $contrato->local ?>.<br>

                    <?php if ($contrato->imediato): ?>
                        <div class="paddingTop20">
                            <?=
                                $contrato->retirada_entrega == "transferencia" ? "<b>Transferência</b>" : "<b class='inline'>".ucfirst($contrato->retirada_entrega)."</b>"
                            ?>: Imediata
                        </div>
                    <?php else: ?>
                        <?php if (($contrato->data_embarque_inicial != $contrato->data_embarque_final) && $contrato->data_embarque_final): ?>
                            <div class="paddingTop20">
                                <?=
                                ($contrato->retirada_entrega == "transferencia")
                                ? "<b>Transferência</b>" . ": de " . ucfirst(date("d/m/y", strtotime($contrato->data_embarque_inicial))). " à " . date("d/m/y", strtotime($contrato->data_embarque_final))
                                : "<b class='inline'>".ucfirst($contrato->retirada_entrega)."</b>" . ": de " . ucfirst(date("d/m/y", strtotime($contrato->data_embarque_inicial))). " à " . date("d/m/y", strtotime($contrato->data_embarque_final));
                                ?>.
                            </div>
                        <?php endif; ?>
                        <?php if (($contrato->data_embarque_inicial !== $contrato->data_embarque_final) && !$contrato->data_embarque_final): ?>
                            <div class="paddingTop20">
                                <?=($contrato->retirada_entrega == "transferencia")
                                ? "<b>Transferência</b>" . ": " . ucfirst(date("d/m/y", strtotime($contrato->data_embarque_inicial)))
                                : "<b class='inline'>".ucfirst($contrato->retirada_entrega)."</b>" . ": ". ucfirst(date("d/m/y", strtotime($contrato->data_embarque_inicial)));
                                ?>.
                            </div>
                        <?php endif; ?>
                        <?php if ($contrato->data_embarque_inicial == $contrato->data_embarque_final): ?>
                            <div class="paddingTop20">
                                <?=($contrato->retirada_entrega == "transferencia")
                                ? "<b>Transferência</b>" . ": " . ucfirst(date("d/m/y", strtotime($contrato->data_embarque_inicial)))
                                : "<b class='inline'>".ucfirst($contrato->retirada_entrega)."</b>" . ": ". ucfirst(date("d/m/y", strtotime($contrato->data_embarque_inicial)));
                                ?>.
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </td>
                <tr>
                    <td class="paddingTop20">
                        <br>
                        <b class="inline">Pagamento:</b> <?= $contrato->pagamento ?> Dados Bancários: 
                        <?= ($contrato->contaBancaria()) ?"{$contrato->contaBancaria()->banco}, conta {$contrato->contaBancaria()->conta} agência {$contrato->contaBancaria()->agencia}" : "Não há conta bancária cadastrada" ?>
                    </td>
                    <td style="float:right" class="paddingTop20" colspan="3">
                    </td>
                </tr>
            <tr>
                <td class="paddingTop20"><b class="inline">Peso e Qualidade:</b>
                    <?= $contrato->peso_qualidade ?? " - " ?> 
                </td>
            </tr>
            <tr>
                <td class="paddingTop20" colspan="3"> <b class="inline">CFOP: </b>
                    <?= $contrato->cfop()->descricao ?? "Nenhum" ?>
                </td>
            </tr>
            <tr>
                <td colspan="3" class="paddingTop20"><b class="inline">Logística/Cotas Vendedor:</b>
                    <?= ($contrato->vendedor->logistica_cotas
                        && strlen($contrato->vendedor->logistica_cotas) > 0)
                    ? $contrato->vendedor->logistica_cotas : "-" ?>
                </td>
            </tr>
            <tr>
                <td colspan="3" class="paddingTop10"><b class="inline">Logística/Cotas Comprador:</b>
                <?= ($contrato->comprador->logistica_cotas && strlen($contrato->comprador->logistica_cotas) > 0) ? $contrato->comprador->logistica_cotas : "-" ?>
                </td>
            </tr>
            
            <?php if ($contrato->observacao || $contrato->exportacao): ?>
                <?php if ($contrato->exportacao): ?>
                    <tr>
                        <td class='paddingTop20' colspan="3">A mercadoria é destinada à exportação, portanto, o comprador se compromete a apresentar ao vendedor, no prazo máximo 180 dias, conforme legislação em vigor a contar do período de embarque fixado pelas partes, os seguintes documentos:
                            <br>a) REGISTRO DE EXPORTAÇÃO emitido nos termos da legislação em vigor à época da entrega das mercadorias. Em anexo ao R.E deverá encaminhar memorando de exportação acompanhado dos documentos abaixo:
                            <br>b) Cópia Registro de Exportação (R.E), que deve indicar no Campo do Fabricante o CNPJ do vendedor.
                            <br>c) Cópia do Comprovante de Exportação (C.E)
                            <br>d) Cópia da Bill of loading (B.L)
                            <br>e) Cópia da Declaração de Despacho de Exportação (D.D.E.);
                        </td>
                    </tr>
                    <tr>
                    <?php if ($contrato->observacao): ?>
                        <td class='obs paddingTop20' colspan="3"><b class="inline">Observações:</b>
                            <div class="obs">
                                <?=nl2br($contrato->observacao)?>
                            </div>
                        </td>
                    <?php endif; ?>
                    </tr>
                    <tr>
                        <td colspan="3" class='paddingTop20' style="color:white">.</td> <!-- TODO -->
                    </tr>
                <?php else: ?>
                        <tr>
                            <td class='paddingTop20' colspan="3">Observações:
                                <div class="obs">
                                    <?php echo str_replace("\r", "<b style='display:inline;color:white !important;'>.</b><br>", $contrato->observacao);  ?>
                                </div>
                            </td>
                        </tr>
                    <tr>
                        <td colspan="3" class='obs' style="color:white">.</td> <!-- TODO -->
                    </tr>
                <?php endif ?>
            <?php endif ?>
            <tr>
                <td class="paddingTop10"><b class="inline">Comissão:</b>
                    <?= $contrato->comissao ?>
                </td>
            </tr>
            <tr>
                <td class="paddingTop20" colspan="3">*Nós, como intermediadores, confirmamos que realizamos nesta data esta transação em seu nome com base nas leis e regulamentos. Qualquer discrepância deverá ser comunicada imediatamente*</td>
            </tr>
            <div class="ass">
                <tr>
                    <div class="assinatura_comprador">
                        <td>_________________________
                            <br>Assinatura do Comprador
                            <br>
                            <?= $contrato->unidadeComprador->cnpj ?>
                        </td>
                    </div>
                    <div class="assinatura_vendedor">
                        <td style="text-align:center !important;">
                            _________________________
                            <br>Assinatura do Vendedor
                            <br>
                            <?= $contrato->unidadeVendedor->cnpj ?>
                        </td>
                    </div>
                </tr>
            </div>
            <tr>
                <div class="assinatura_ceagro">
                    <td><pre>____________________________________________</pre>
                        <br><pre>CEAGRO CORRETORA DE MERCADORIAS LTDA</pre>
                        <br><pre>90.880.204/0001-57</pre>
                    </td>
                </div>
            </tr>
        </table>
</section>
</body>
<!--Developed by Lucas Monteiro and Ruan Vinícius-->
</html>

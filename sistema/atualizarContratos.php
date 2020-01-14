<?php include 'partials/cabecalho.html'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<style>
	#clientes {
		transition: 0.5;
	}
</style>
<div class="wrapper">
	<?php include "partials/header.html"; ?>
	<?php include "partials/menu.html"; ?>
    <div class="content-wrapper">
		<section class="content-header">
        <h1>
            Painel de Controle
            <small>Atualizar Contratos</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Atualizar</li>
        </ol>
        </section>
        <section id="atualizar">
            <h1 style="text-align:center; color:orange; font-size: 200px;">
                <i class="fa fa-warning"></i>
            </h1>
            <h2 style="text-align:center;">Seus contratos futuros podem estar desatualizados. <br>Clique em atualizar para atualiza-los.</h2>
            <div style="text-align:center; margin-top:40px;">
                <button id="botao-atualizar" class="btn btn-success">ATUALIZAR</button><br>
                <i id="loading" style="margin-top:16px;display:none;" class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
            </div>
        </section>
        <section id="tudo-pronto" style="display: none;">
            <h1 style="text-align:center; color:green; font-size: 200px;">
                <i class="fa fa-check"></i>
            </h1>
            <h2 style="text-align:center;">Tudo pronto!</h2>
        </section>
        <section id="erro" style="display: none;">
            <h1 style="text-align:center; color:red; font-size: 200px;">
                <i class="fa fa-times"></i>
            </h1>
            <h2 style="text-align:center;">Ocorreu um erro. <br>Tente novamente mais tarde.</h2>
        </section>
    </div>
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <i class="fab fa-optin-monster"></i>
        </div>
        Copyright © 2019 CEAGRO - Todos os Direitos Reservados. Feito com  <img src="http://dom.com.vc/dom.com.vc.gif" alt="DOM Creative Consulting" height="20" width="20">  por <a href="https://dom.com.vc">DOM</a>
    </footer>
    <div class="control-sidebar-bg"></div>
</div>
<?php include 'partials/imports.html' ?>
<script src="../sistema/public/assets/js/atualizarContratos.js"></script>
<?php include 'partials/rodape.html' ?>

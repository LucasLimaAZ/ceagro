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
            <small>Filtro de Contratos</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Filtro</li>
        </ol>
        </section>
        <section>
            <div class="row" style="margin:1%;">
                <div class="col-xs-12" style="background-color:white;margin-top:50px;margin:5px;padding:2%;">
                    <form role="form" id="datas">
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="page-header"><i class="fa fa-calendar"></i> Filtrar por data</h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <label for="data-inicial">Data inicial:</label>
                                <input type="date" class="form-control" name="data-inicial">
                            </div>
                            <div class="col-md-5">
                                <label for="data-final">Data final:</label>
                                <input type="date" class="form-control" name="data-final">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" style="margin-top:24px" class="btn btn-primary">Filtrar</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-xs-12" style="background-color:white;margin-top:50px;margin:5px;padding:2%;">
                    <form role="form" id="contrato">
                        <div class="row">
                            <div class="col-md-12">
                            <h2 class="page-header"><i class="fa fa-user"></i> Filtrar por cliente</h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="vendedor_id">Nome Fantasia</label>
                                    <select class="form-control select2" name="clientes" style="width: 100%;" id="clientes" required></select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-xs-12" style="background-color:white;margin-top:50px;margin:5px;padding:2%;">
                    <form role="form" id="contrato">
                        <div class="row">
                            <div class="col-md-12">
                            <h2 class="page-header"><i class="fa fa-copy"></i> Filtrar por safra</h2>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-xs-12">
                                <a href="../back-end/pdfs/contratos/atuais"><button type="button" style="margin-top:24px" class="btn btn-primary">Atual</button></a>
                            </div>
                            <div class="col-xs-12">
                                <a href="../back-end/pdfs/contratos/futuros"><button type="button" style="margin-top:24px" class="btn btn-primary">Futura</button></a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-2"></div>
            </div>
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
<script src="../sistema/public/assets/js/filtro.js"></script>
<?php include 'partials/rodape.html' ?>

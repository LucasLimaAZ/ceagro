<?php include 'partials/cabecalho.html' ?>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
	<?php include "partials/header.html"; ?>
	<?php include "partials/menu.html"; ?>
    <div class="wrapper">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-xs-12">
                    <section class="invoice">
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="page-header">
                                    <i class="fa fa-address-card"></i> Dados do Usuário
                                </h2>
                            </div>
                        </div>
                        <div class="row invoice-info">
                            <form role="form" id="cliente">
                                <div class="box-body">
                                    <div class="form-row">
                                        <div class="col-xs-12">
                                            <div class="form-group">
                                                <label for="razao_social">Nome do usuário</label>
                                                <input type="text" class="form-control" name="nome" placeholder="Digite o nome fantasia do seu cliente" autocomplete="off" required>
                                            </div>
                                        </div>
                                        <div class="col-xs-12">
                                            <div class="form-group">
                                                <label for="responsavel_logistica_cotas">Login</label>
                                                <input type="text" class="form-control" name="logistica_cotas" placeholder="Digite as informações necessárias" autocomplete="off" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <?php require('partials/components/erro.html') ?>
                                    <?php require('partials/components/success.html') ?>
                                    <button type="submit" class="btn btn-primary pull-right"></button>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <div class="control-sidebar-bg"></div>
    </div>
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <i class="fab fa-optin-monster"></i>
        </div>
        Copyright © 2019 CEAGRO - Todos os Direitos Reservados. Feito com  <img src="http://dom.com.vc/dom.com.vc.gif" alt="DOM Creative Consulting" height="20" width="20">  por <a href="https://dom.com.vc">DOM</a>
    </footer>
    <style>
        .ativado {
            background-color : #3c8dbc  !important;
            color: #ffffff;
        }
    </style>
	<?php include 'partials/imports.html' ?>
    <script src="public/assets/js/usuarioForm.js"></script>
	<?php include 'partials/rodape.html' ?>
	</div>
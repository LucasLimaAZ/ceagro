<?php include 'partials/cabecalho.html' ?>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
	<?php include "partials/header.html"; ?>
	<?php include "partials/menu.html"; ?>
        <div class="content-wrapper">
		<section class="content-header">
            <h1>
                Painel de Controle
                <small>Gestão de Contratos</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <section class="invoice">
                        <div class="row">
                            <div class="col-xs-12">
                                <h2 class="page-header">
                                <i class="fa fa-address-card"></i> Cadastrar CFOP
                                </h2>
                            </div>
                        </div>
                        <div class="row invoice-info">
                            <form role="form" id="cfop">
                                <div class="box-body">
                                    <div class="form-row">
                                        <div class="col-xs-12">
                                            <div class="form-group">
                                                <label for="descricao">CFOP</label>
                                                <input type="text" class="form-control" name="descricao" placeholder="Digite o código  do CFOP" autocomplete="off" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary pull-right">Salvar</button>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
            <div class="row invoice">
                <div class="col-xs-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Descrição</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="cfops">
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        </div>
            <div class="control-sidebar-bg"></div>
        </div>

        <div class="modal fade" id="modal-aviso">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title">AVISO!</h4>
					</div>
					<div class="modal-body">
						<p>Você deseja realmente excluir esta cfop?</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default btn-danger pull-left" style="color:white" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary" id="deletar" data-dismiss="modal">Excluir</button>
					</div>
				</div>
			</div>
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
    <script src="public/assets/js/cfops.js"></script>

<?php include 'partials/rodape.html' ?>

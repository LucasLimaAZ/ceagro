<?php include 'partials/cabecalho.html' ?>
<body class="hold-transition skin-blue sidebar-mini" >
	<div class="wrapper">
	<?php include "partials/header.html"; ?>
	<?php include "partials/menu.html"; ?>
        <div class="content-wrapper">
<<<<<<< HEAD
		<div class="row">
			<div class="col-md-8 offset-md-2">
				<button id="mostrar-futuros" class="btn btn-primary">Futuros</button>
				<button id="mostrar-atuais" class="btn btn-primary">Atuais</button>
			</div>
		</div>
			<section class="content aba-atuais"> <!-- aba atuais -->

				<div class="row">
					<div class="col-xs-12">
						<div class="box box-info">
							<div class="box-header">
								<h3 class="box-title">Contratos</h3>
							</div>
							<div class="box-body tabelaListaContratos">
								<table class="table table-bordered table-striped" id="contratos-atuais">
									<thead>
										<tr>
											<th>Número ATUAL</th>
											<th>Comprador</th>
											<th>Vendedor</th>
											<th>Produto</th>
											<th>Baixar</th>
											<th>Excluir</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
							<div id="overlay" class="overlay">
								<i class="fa fa-refresh fa-spin"></i>
							</div>
						</div>
					</div>
				</div>

          	</section><!-- fim aba atuais -->
			<section class="aba-futuros"><!-- aba futuros -->

=======
	
			<section class="content">
>>>>>>> eb2b20cda9007687971f20df3510a5c001e5e26b
				<div class="row">
					<div class="col-xs-12">
						<div class="box box-info">
							<div class="box-header">
								<h3 class="box-title">Contratos</h3>
								<div class="row">
									<div class="col-xs-12 text-right">
										<button id="btn-futuros" class="btn btn-flat">Futuros</button>
										<button id="btn-atuais" class="btn btn-flat">Atuais</button>
									</div>
								</div>
							</div>
							<div class="box-body tabelaListaContratos">
<<<<<<< HEAD
								<table class="table table-bordered table-striped" id="contratos-futuros">
=======
								
								<table class="table table-bordered table-striped" id="contratos">
>>>>>>> eb2b20cda9007687971f20df3510a5c001e5e26b
									<thead>
										<tr>
											<th>Número</th>
											<th>Comprador</th>
											<th>Vendedor</th>
											<th>Produto</th>
											<th>Baixar</th>
											<th>Excluir</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
							<div id="overlay" class="overlay">
								<i class="fa fa-refresh fa-spin"></i>
							</div>
						</div>
					</div>
				</div>
<<<<<<< HEAD
          	</section><!-- fim aba futuros -->
=======
          	</section>
>>>>>>> eb2b20cda9007687971f20df3510a5c001e5e26b
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
					<p>Você deseja realmente excluir este contrato?</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-danger pull-left" style="color:white" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" id="deletarContrato">Excluir</button>
				</div>
            </div>
		</div>
	</div>

	<div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content" style="background: rgba(0,0,0,0)">
                <div class="modal-body" style="background: rgba(0,0,0,0)">
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
	<script type="module" src="public/assets/js/contratosLista.js"></script>
	<?php include 'partials/rodape.html' ?>
<?php include 'partials/cabecalho.html' ?>
<body class="hold-transition skin-blue sidebar-mini" >
	<div class="wrapper">
	<?php include "partials/header.html"; ?>
	<?php include "partials/menu.html"; ?>
        <div class="content-wrapper">
	
			<section class="content">
				<div class="row">
                    <div class="col-xs-12">
                        <?php require('partials/components/erroAoCarregar.html') ?>
                        <?php require('partials/components/success.html') ?>
                    </div>
					<div class="col-xs-12">
						<div class="box box-info">
							<div class="box-header">
								<h3 class="box-title">Usuários do sistema</h3>
							</div>
							<div class="box-body tabelaListaUsuarios">
								<table class="table table-bordered table-striped" id="usuarios">
									<thead>
										<tr>
											<th>Nome</th>
											<th>Login</th>
											<th>Senha</th>
											<th></th>
											<th></th>
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
					<p>Você deseja realmente excluir este usuario?</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-danger pull-left" style="color:white" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" id="deletarUsuario">Excluir</button>
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
	<script type="module" src="public/assets/js/usuariosLista.js"></script>
	<?php include 'partials/rodape.html' ?>
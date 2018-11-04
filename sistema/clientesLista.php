<?php include 'partials/cabecalho.html'?>
<body class="hold-transition skin-blue sidebar-mini" onload="buscar()">
	<div class="wrapper">
		<?php include "partials/header.html";?>
		<?php include "partials/menu.html";?>
		<div class="content-wrapper">
			<section class="content">
				<table class="table">
					<thead>
						<td colspan="2">
							<form method="post">
								<div class="row">
									<div class="col-md-12">
										<div class="box">
											<div class="box-header with-border">
												<div class="input-group col-xs-6">
													<input type="text" id='filtro' name="criterio" class="form-control" onkeyup="filtrar()">
												</div>
											</div>
											<div class="box-body">
												<table class="table table-bordered" id="clientes">
													<thead>
														<tr>
															<th style="width: 20px"></th>
															<th hidden=""><a href="clientes.php">Id Cliente</a></th>
															<th style="width: 200px">Razão Social</th>
															<th>Cnpj</th>
															<th style="width: 150px">Insc Estadual</th>
														</tr>
													</thead>
												</table>
											</div>
										</div>
									</div>
								</td>
							</thead>
						</table>
					</form>
				</section>
			</div>
			<footer class="main-footer">
				<div class="pull-right hidden-xs">
					<i class="fab fa-optin-monster"></i>
				</div>
				Copyright &copy; 2018 - 2019 - ektech.com.br - Todos Direitos Reservados.
			</footer>
			<div class="control-sidebar-bg"></div>
		</div>
		<?php include 'partials/imports.html'?>
		<script src="public/assets/js/clientes.js"></script>
		<?php include 'partials/rodape.html'?>
	</div>
<?php include 'partials/cabecalho.html' ?>
<body class="hold-transition skin-blue sidebar-mini" >
	<div class="wrapper">
	<?php include "partials/header.html"; ?>
	<?php include "partials/menu.html"; ?>
    <div class="content-wrapper">
			<section class="content">
				<div class="row">
					<div class="col-xs-12">
						<div class="box box-primary">
							<div class="box-header with-border">
								<h3 class="box-title">Relatórios</h3>
								<div class="box-tools pull-right">
									<div class="form-group">
										<label class="col-sm-6 control-label">Data de geração</label>
										<div class="col-sm-6">
											<input type="text" name="data_embarque" class="form-control" id="reservation">
										</div>
                	</div>
								</div>
							</div>
							<div class="box-body">
								<ul class="nav nav-stacked" id="lista">
									<!-- <li><a href="http://" target="_blank" rel="noopener noreferrer"></a></li> -->
								</ul>								
							</div>
						</div>
					</div>
				</div>
      </section>
    </div>
		<div class="control-sidebar-bg"></div>
	</div>
	<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <i class="fab fa-optin-monster"></i>
    </div>
    Copyright © 2019 CEAGRO - Todos os Direitos Reservados. Feito com  <img src="http://dom.com.vc/dom.com.vc.gif" alt="DOM Creative Consulting" height="20" width="20">  por <a href="https://dom.com.vc">DOM</a>
  </footer>
  <div class="control-sidebar-bg"></div>
	<?php include 'partials/imports.html' ?>
	<script src="public/assets/js/relatorios.js"></script>
	<script src="adminlte/bower_components/moment/min/moment.min.js"></script>
	<script src="adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
	<script src="adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
	<script>
		$('#reservation').daterangepicker({
				locale: {
				format: 'DD/MM/YYYY'
			}
		});
		// $('#reservation2').datepicker({
		// 		locale: {
		// 		format: 'DD/MM/Y	YYY'
		// 	}
		// });
		$.fn.datepicker.dates['pt'] = {
			days: ["Domingo", "Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sábado"],
			daysShort: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab"],
			daysMin: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab"],
			months: ["Janeirp", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julio", "Agosto", "Setmebro", "Outubro", "Novembro", "Dezembro"],
			monthsShort: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"],
			today: "Hoje",
			clear: "Limpar",
			format: "dd/mm/yyyy",
			titleFormat: "MM yyyy", /* Leverages same syntax as 'format' */
			weekStart: 0
		};
		$('#reservation2').datepicker({
			autoclose: true,
			language:'pt'
		})
	</script>
	<?php include 'partials/rodape.html' ?>

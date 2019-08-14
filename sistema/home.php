<?php include 'partials/cabecalho.html' ?>
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
        <small>Gestão de Contratos</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-lg-4 col-xs-12">
          <div class="small-box bg-aqua">
            <div class="inner" id="contratos">
              <h3></h3>

              <p>Contratos atuais</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a target="_blank" href="https://ceagro.com.br/back-end/pdfs/contratos/atuais" class="small-box-footer">Ver contratos <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-4 col-xs-12">
          <div class="small-box bg-green">
            <div class="inner" id="contratos_fut">
              <h3>-</h3>

              <p>Contratos futuros</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a target="_blank" href="https://ceagro.com.br/back-end/pdfs/contratos/futuros" class="small-box-footer">Ver contratos <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-4 col-xs-12">
          <div class="small-box bg-yellow">
            <div class="inner" id="clientes">
              <h3></h3>

              <p>Clientes</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="https://ceagro.com.br/sistema/clientesLista.php" class="small-box-footer">Ver lista <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12 col-lg-6">
          <div class="box box-danger">
              <div class="box-header with-border">
                <h3 class="box-title">Seus principais Compradores</h3>
  
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <div class="box-body">
                <canvas id="comprador" style="height:250px"></canvas>
              </div>
          </div>
        </div>
        <div class="col-xs-12 col-lg-6">
          <div class="box box-danger">
              <div class="box-header with-border">
                <h3 class="box-title">Seus principais Vendedores</h3>
  
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <div class="box-body">
                <canvas id="vendedor" style="height:250px"></canvas>
              </div>
          </div>
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
		<div class="control-sidebar-bg"></div>
	</div>
	<?php include 'partials/imports.html' ?>
	<script src="../sistema/public/assets/js/login.js"></script>
  <script src="public/assets/js/index.js"></script>
  <script src="adminlte/bower_components/chart.js/Chart.js"></script>
  <script>
    function getRandomColor() {
      var letters = '0123456789ABCDEF';
      var color = '#';
      for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
      }
      return color;
    }

    var compradorCanvas = $('#comprador').get(0).getContext('2d');
    var compradorGrafico = new Chart(compradorCanvas);

    var vendedorCanvas = $('#vendedor').get(0).getContext('2d');
    var vendedorGrafico = new Chart(vendedorCanvas);

    var compradores;
    var vendedores;

    var compradoresGraficosDados;
    var vendedoresGraficosDados;


  $.get("../back-end/contratos/dados-compradores")
  .done(dados => {
    compradores = JSON.parse(dados);

    for(comprador in compradores) {
      compradores[comprador].value = compradores[comprador].avg;
      compradores[comprador].color = getRandomColor();
      compradores[comprador].highlight = compradores[comprador].color;
      compradores[comprador].label = compradores[comprador].cliente;
    }

    compradoresGraficosDados = compradores;

    var compradoresGraficoOptions     = {
      segmentShowStroke    : true,
      segmentStrokeColor   : '#fff',
      segmentStrokeWidth   : 2,
      percentageInnerCutout: 50, // This is 0 for Pie charts
      animationSteps       : 100,
      animationEasing      : 'easeOutBounce',
      animateRotate        : true,
      animateScale         : false,
      responsive           : true,
      maintainAspectRatio  : true,
      legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
    }
    compradorGrafico.Doughnut(compradoresGraficosDados, compradoresGraficoOptions)
  });
  
  $.get("../back-end/contratos/dados-vendedores")
  .done(dados => {
    vendedores = JSON.parse(dados);

    for(vendedor in vendedores) {
      vendedores[vendedor].value = vendedores[vendedor].avg;
      vendedores[vendedor].color = getRandomColor();
      vendedores[vendedor].highlight = vendedores[vendedor].color;
      vendedores[vendedor].label = vendedores[vendedor].cliente;
    }

    vendedoresGraficosDados = vendedores;

    var vendedoresGraficoOptions     = {
      segmentShowStroke    : true,
      segmentStrokeColor   : '#fff',
      segmentStrokeWidth   : 2,
      percentageInnerCutout: 50, // This is 0 for Pie charts
      animationSteps       : 100,
      animationEasing      : 'easeOutBounce',
      animateRotate        : true,
      animateScale         : false,
      responsive           : true,
      maintainAspectRatio  : true,
      legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
    }
    vendedorGrafico.Doughnut(vendedoresGraficosDados, vendedoresGraficoOptions)
  });
  </script>
	<?php include 'partials/rodape.html' ?>

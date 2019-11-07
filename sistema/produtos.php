<?php include 'partials/cabecalho.html' ?>
<body class="hold-transition skin-blue sidebar-mini" onload="buscar()">
	<div class="wrapper">
	<?php include "partials/header.html"; ?>
	<?php include "partials/menu.html"; ?>
    <div class="wrapper">
        <div class="content-wrapper">
            <br>
            <section class="invoice">
                <div class="row">
                    <div class="col-xs-12">
                        <h2 class="page-header">
                        <i class="fa fa-cart-plus"></i> Produtos
                        </h2>
                    </div>
                </div>

                <div class="row invoice-info">
                    <form role="form" id="produto">
                        <div class="box-body">
                            <div class="form-row">
                                <div class="col-xs-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="nome">Nome</label>
                                        <input type="text" class="form-control" name="nome" placeholder="Digite o nome do produto" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="nome">Código</label>
                                        <input type="text" class="form-control" name="codigo" placeholder="Digite o código do produto" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label for="pagamento">Descrição</label>
                                        <textarea type="text" class="form-control" name="descricao" rows="6" placeholder="Digite as informações sobre o produto" required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary pull-right">Salvar</button>
                        </div>
                    </form>
                </div>

                <div class="row">
                    <div class="col-xs-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Nome</th>
                                    <th>Descrição</th>
                                    <th>Deletar</th>
                                </tr>
                            </thead>
                            <tbody id="produtos_lista">
                            </tbody>
                        </table>
                    </div>
                </div>

            </section>
            <div class="clearfix"></div>
        </div>
        <div class="control-sidebar-bg"></div>
    </div>
    
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content" style="background: rgba(0,0,0,0)">
                <div class="modal-body" style="background: rgba(0,0,0,0)">
                </div>
            </div>
        <!-- /.modal-content -->
        </div>
          <!-- /.modal-dialog -->
    </div>
    <footer class="main-footer">
			<div class="pull-right hidden-xs">
				<i class="fab fa-optin-monster"></i>
			</div>
			 Copyright © 2019 CEAGRO - Todos os Direitos Reservados. Feito com  <img src="http://dom.com.vc/dom.com.vc.gif" alt="DOM Creative Consulting" height="20" width="20">  por <a href="https://dom.com.vc">DOM</a>
		</footer>
	<?php include 'partials/imports.html' ?>
    <script src="public/assets/js/produtos.js"></script>
	<?php include 'partials/rodape.html' ?>
	</div>

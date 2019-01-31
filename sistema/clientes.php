<?php include 'partials/cabecalho.html' ?>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
	<?php include "partials/header.html"; ?>
	<?php include "partials/menu.html"; ?>
    <div class="wrapper">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-xs-6">
                    <section class="invoice">
                        <div class="row">
                            <div class="col-xs-12">
                                <h2 class="page-header">
                                <i class="fa fa-address-card"></i> Dados Base
                                </h2>
                            </div>
                        </div>
                        <div class="row invoice-info">
                            <form role="form" id="cliente">
                                <div class="box-body">
                                    <div class="form-row">
                                        <div class="col-xs-12">
                                            <div class="form-group">
                                                <label for="razao_social">Nome Fantasia</label>
                                                <input type="text" class="form-control" name="nome_fantasia" placeholder="Digite o nome fantasia do seu cliente" autocomplete="off" required>
                                            </div>
                                        </div>
                                        <div class="col-xs-12">
                                            <div class="form-group">
                                                <label for="responsavel_logistica_cotas">Logística/Cotas</label>
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

                <div class="col-xs-6">
                    <section class="invoice">
                        <div class="row">
                            <div class="col-xs-12">
                                <h2 class="page-header">
                                <i class="fa fa-address-card"></i> Unidade
                                </h2>
                            </div>
                        </div>
                        <div class="row invoice-info">
                            <form role="form" id="unidade">
                                <div class="box-body">
                                    <div class="form-row">
                                        <div class="col-xs-12 col-lg-6">
                                            <div class="form-group">
                                                <label for="cnpj">CNPJ/CPF</label>
                                                <!-- <input type="text" class="form-control" name="cnpj" placeholder="Digite o cnpj" autocomplete="off"  data-inputmask='"mask": "99.999.999/9999-99"' data-mask> -->
                                                <input type="text" class="form-control" name="cnpj" placeholder="Digite o CNPJ ou CPF" autocomplete="off" >
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-lg-6">
                                            <div class="form-group">
                                                <label for="inscricao_estadual">Inscrição Estadual</label>
                                                <input type="text" class="form-control" name="inscricao_estadual" placeholder="Digite a inscrição estadual" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-xs-12">
                                            <div class="form-group">
                                                <label for="razao_social">Razão Social</label>
                                                <input type="text" class="form-control" name="razao_social" placeholder="Digite a razão social" autocomplete="off" required>
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
            <div class="row">

                <div class="col-xs-12">
                    <section class="invoice">
                    <div class="row">
                            <div class="col-xs-12">
                                <h2 class="page-header">
                                    <i class="fa fa-address-book-o"></i> Lista de Unidades
                                </h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>CNPJ</th>
                                            <th>Inscrição Estadual</th>
                                            <th>Razão Social</th>
                                            <th>Deletar</th>
                                        </tr>
                                    </thead>
                                    <tbody id="unidades">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                </div>


                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 endereco">
                    <section class="invoice">
                        <div class="row">
                            <div class="col-xs-12">
                                <h2 class="page-header">
                                <i class="fa fa-map"></i> Endereço:
                                </h2>
                            </div>
                        </div>
                        <div class="row invoice-info">
                            <form role="form" id="endereco">
                                <div class="box-body">
                                    <div class="form-row">
                                        <div class="col-xs-12 col-lg-8">
                                            <div class="form-group">
                                                <label for="rua">Rua</label>
                                                <input type="text" class="form-control" name="rua" placeholder="Digite a rua" autocomplete="off" required>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-lg-4">
                                            <div class="form-group">
                                                <label for="numero">Número</label>
                                                <input type="text" class="form-control" name="numero" placeholder="Digite o número" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-xs-12 col-lg-6">
                                            <div class="form-group">
                                                <label for="cidade">Cidade</label>
                                                <input type="text" class="form-control" name="cidade" placeholder="Digite a cidade" autocomplete="off" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-lg-6">
                                            <div class="form-group">
                                                <label for="bairro">Bairro</label>
                                                <input type="text" class="form-control" name="bairro" placeholder="Digite o bairro" autocomplete="off" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-xs-12">
                                            <div class="form-group">
                                                <label for="complemento">Complemento</label>
                                                <input type="text" class="form-control" name="complemento" placeholder="Digite o complemento" autocomplete="off" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-xs-12 col-lg-4">
                                            <div class="form-group">
                                                <label for="estado">Estado</label>
                                                <input type="text" class="form-control" name="estado" placeholder="Digite o Estado" autocomplete="off" required>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-lg-8">
                                            <div class="form-group">
                                                <label for="cep">CEP</label>
                                                <input type="text" class="form-control" name="cep" placeholder="Digite o CEP" autocomplete="off" required data-inputmask='"mask": "99999-999"' data-mask>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="box-footer"> 
                                    <?php require('partials/components/erro.html') ?>
                                    <?php require('partials/components/unidade.html') ?>
                                    <?php require('partials/components/success.html') ?>
                                    <button type="submit" class="btn btn-primary pull-right"></button>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>

                <div class="col-xs-12">
                    <section class="invoice">
                        <div class="row">
                            <div class="col-xs-12">
                                <h2 class="page-header">
                                <i class="fa fa-map-o"></i> Endereços
                                </h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Estado</th>
                                            <th>Cidade</th>
                                            <th>Rua</th>
                                            <th>CEP</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="enderecos">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 contasBancarias">
                    <section class="invoice">
                        <div class="row">
                            <div class="col-xs-12">
                                <h2 class="page-header">
                                <i class="fa fa-university"></i> Dados Bancários:
                                </h2>
                            </div>
                        </div>
                        <div class="row invoice-info">
                            <form role="form" id="contasBancarias">
                                <div class="box-body">
                                    <div class="form-row">
                                        <div class="col-xs-12 col-lg-4">
                                            <div class="form-group">
                                                <label for="banco">Banco</label>
                                                <input type="text" class="form-control" name="banco" placeholder="Digite o banco" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-lg-4">
                                            <div class="form-group">
                                                <label for="agencia">Agência</label>
                                                <input type="text" class="form-control" name="agencia" placeholder="Digite a agência autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-lg-4">
                                            <div class="form-group">
                                                <label for="conta">Conta</label>
                                                <input type="text" class="form-control" name="conta" placeholder="Digite a conta" autocomplete="off">
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
                        <div class="row">
                            <div class="col-xs-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Banco</th>
                                            <th>Agência</th>
                                            <th>Conta</th>
                                            <th>Deletar</th>
                                        </tr>
                                    </thead>
                                    <tbody id="contas_bancarias">
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </section>
                </div>
            </div>

            <div class="clearfix"></div>
            </div>
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
					<p>Você deseja realmente excluir esta Unidade?</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-danger pull-left" style="color:white" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" id="deletarUnidade">Excluir</button>
				</div>
            </div>
		</div>
	</div>

    <div class="modal fade" id="modal-conta">
		<div class="modal-dialog">
            <div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title">AVISO!</h4>
              	</div>
				<div class="modal-body">
					<p>Você deseja realmente excluir esta Conta?</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-danger pull-left" style="color:white" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" data-dismiss="modal" id="deletarConta">Excluir</button>
				</div>
            </div>
		</div>
	</div>
    
    <div class="modal fade" id="modal-endereco">
		<div class="modal-dialog">
            <div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title">AVISO!</h4>
              	</div>
				<div class="modal-body">
					<p>Você deseja realmente excluir este Endereço?</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-danger pull-left" style="color:white" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" id="deletarEndereco">Excluir</button>
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
    <style>
        .ativado {
            background-color : #3c8dbc  !important;
            color: #ffffff;
        }
    </style>
	<?php include 'partials/imports.html' ?>
    <script src="public/assets/js/clientes.js"></script>
    <script src="adminlte/plugins/input-mask/jquery.inputmask.js"></script>
    <script src="adminlte/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="adminlte/plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <script>
        $('[data-mask]').inputmask();
    </script>
	<?php include 'partials/rodape.html' ?>
	</div>

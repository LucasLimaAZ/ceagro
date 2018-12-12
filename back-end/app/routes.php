<?php
use App\Core\App;

$urlBase = App::get('config')['rotas'];
$router->get("{$urlBase}numero-confirmacao", "ContratosController@numeroConfirmacao");

$router->get("{$urlBase}clientes", "ClientesController@index");
$router->post("{$urlBase}clientes", "ClientesController@store");
$router->get("{$urlBase}clientes/{cliente}", "ClientesController@show");
$router->put("{$urlBase}clientes/{cliente}", "ClientesController@update");

$router->get("{$urlBase}clientes/contatos", "ContatosController@index");
$router->get("{$urlBase}clientes/{cliente}/contatos", "ContatosController@index");
$router->post("{$urlBase}clientes/contatos", "ContatosController@store");

$router->get("{$urlBase}clientes/{cliente}/enderecos", "EnderecosController@index");
$router->post("{$urlBase}clientes/enderecos", "EnderecosController@store");
$router->put("{$urlBase}clientes/enderecos/{endereco}", "EnderecosController@update");

$router->post("{$urlBase}clientes/contas-bancarias", "ContasBancariasController@store");
$router->get("{$urlBase}clientes/{cliente}/contas-bancarias", "ContasBancariasController@show");

$router->get("{$urlBase}clientes/{cliente}/estabelecimentos", "EstabelecimentosController@index");
$router->get("{$urlBase}estabelecimentos", "EstabelecimentosController@index");
$router->get("{$urlBase}estabelecimentos/{estabelecimento}", "EstabelecimentosController@show");
$router->post("{$urlBase}estabelecimentos", "EstabelecimentosController@store");

$router->get("{$urlBase}produtos", "ProdutosController@index");
$router->post("{$urlBase}produtos", "ProdutosController@store");
$router->get("{$urlBase}produtos/tipos", "ProdutosController@tipos");

$router->get("{$urlBase}contratos", "ContratosController@index");
$router->get("{$urlBase}contratos/{contrato}", "ContratosController@show");
$router->post("{$urlBase}contratos", "ContratosController@store");

$router->put("{$urlBase}contratos/{contrato}", "ContratosController@update");

$router->delete("{$urlBase}contratos/{contrato}/adendos/{adendo}", "ContratosController@removerAdendo");
$router->post("{$urlBase}adendos", "ContratosController@adicionarAdendos");

$router->get("{$urlBase}adaptacao", "Adaptacao\AdaptacaoController@adaptarClientes");
$router->get("{$urlBase}pdfs/contratos/{contrato}", "PDF\ContratosController@index");
$router->get("{$urlBase}unidades-medidas", "UnidadesMedidasController@index");

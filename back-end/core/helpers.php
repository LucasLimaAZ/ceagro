<?php

function view($pagina, $dados = [])
{
    extract((array)$dados);
    require "app/views/{$pagina}.php";
}

function redirecionar($path)
{
    header("Location: /{$path}");
}


function toJson($dados, $code = 200) {
    $status = array(
        200 => '200 OK',
        400 => '400 Bad Request',
        422 => 'Unprocessable Entity',
        500 => '500 Internal Server Error',
        401 => '401 Não autorizado'
    );

    http_response_code($code);
    header('Status: '.$status[$code]);
    echo json_encode([$dados, $code]);
}

function dd($dados)
{
    echo "<pre>";
    var_dump($dados);
    echo "</pre>";
    die();
}

if( !function_exists('apache_request_headers') ) {
///
function apache_request_headers() {
  $arh = array();
  $rx_http = '/\AHTTP_/';
  foreach($_SERVER as $key => $val) {
    if( preg_match($rx_http, $key) ) {
      $arh_key = preg_replace($rx_http, '', $key);
      $rx_matches = array();
      // do some nasty string manipulations to restore the original letter case
      // this should work in most cases
      $rx_matches = explode('_', $arh_key);
      if( count($rx_matches) > 0 and strlen($arh_key) > 2 ) {
        foreach($rx_matches as $ak_key => $ak_val) $rx_matches[$ak_key] = ucfirst($ak_val);
        $arh_key = implode('-', $rx_matches);
      }
      $arh[$arh_key] = $val;
    }
  }
  return( $arh );
}
///
}

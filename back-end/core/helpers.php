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
        500 => '500 Internal Server Error'
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

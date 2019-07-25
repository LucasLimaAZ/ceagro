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

function dd($dados)
{
    echo "<pre>";
    var_dump($dados);
    echo "</pre>";
    die();
}

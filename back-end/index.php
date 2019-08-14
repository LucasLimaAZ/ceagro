<?php
require "vendor/autoload.php";
require "core/helpers.php";
require "core/bootstrap.php";

use App\Core\Request;
use App\Core\Router;
use App\Core\App;
use App\Model\User;

if(!preg_match('/login/',Request::uri()) || !preg_match('/logout/',Request::uri())) {
    if(!User::check()) {
        toJson("Não autorizado", 401);
        die();
    }
}

try {
    Router::carregar('app/routes.php')->direcionar(
        Request::uri(),
        Request::method()
    );
} catch (\Exception $e) {
    echo $e->getMessage();
}

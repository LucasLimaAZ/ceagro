<?php
require "vendor/autoload.php";
require "core/helpers.php";
require "core/bootstrap.php";

use App\Core\Request;
use App\Core\Router;
use App\Core\App;
use App\Models\User;

if((preg_match('/login/',Request::uri()) < 1) && (preg_match('/logout/',Request::uri()) < 1)&& (preg_match('/pdfs/',Request::uri()) < 1)) {
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

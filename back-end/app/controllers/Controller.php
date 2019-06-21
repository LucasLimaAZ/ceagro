<?php

namespace App\Controllers;

class Controller {

    public function responderJSON($dados, $code = 200) {
        echo json_encode($dados, $code);
    }
}
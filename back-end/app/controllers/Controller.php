<?php

namespace App\Controllers;

class Controller {

    public function responderJSON($dados) {
        echo json_encode($dados);
    }
}
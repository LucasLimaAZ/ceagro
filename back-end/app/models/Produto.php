<?php

namespace App\Models;

use App\Core\App;

class Produto extends Model
{
    public $id;
    public $nome;
    public $codigo;
    public $descricao = null;
    
    // public $preco;
    public static $table = "produtos";

}

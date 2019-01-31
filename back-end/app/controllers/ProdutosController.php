<?php

namespace App\Controllers;

use App\Core\App;
use App\Models\Produto;

class ProdutosController extends Controller
{
    /**
     * Retorna todos os de produtos.
     * 
     * @return App\Models\Produto $produtos
     */
    public function index()
    {
        $produtos = Produto::get();
        return $this->responderJSON($produtos);
    }

    /**
     * Cadastra um novo produto.
     * 
     * @param Array $produto
     * @return JSON
     */
    public function store($produto)
    {
        $produtoId = Produto::create($produto);
        return $this->responderJSON($produtoId);

    }

    /**
     * Atualiza um produto
     * 
     * @param Array $produto
     * @return App\Models\Produto $produto
     */
    public function update($produto)
    {
        $produtoId = Produto::update($produto, ['id', $produto['produto']]);
        $produto = Produto::find(['id', $produtoId]);

        return $this->responderJSON($produto);
    }

    public function destroy($produto)
    {
        $delete = Produto::delete(["id", $produto]);
        return $this->responderJSON($delete);
    }
}

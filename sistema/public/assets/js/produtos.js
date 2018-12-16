var produto = null;
var produtos = null;

function temProduto() {
    return (produto) ? true : false;
}

/**
 * INÍCIO AJAX 
 */

$("#produto").submit(function (event) {
    event.preventDefault();
    (temProduto()) ? atualizar() : cadastrar();
});

/**
 *  FIM AJAX
 */

/**
 * Cadastra um novo produto.
 */
function cadastrar() {
    mostrarModal();
    var dados = $('#produto').serialize();
    $.post('../back-end/produtos', dados).done(() => {
        buscar();
    }).always(() => esconderModal());
}

/**
 * Atualiza um produto químico.
 */
function atualizar() {
    mostrarModal();
    var dados = $('#produto').serialize();
    $.ajax({
        url: `../back-end/produtos/${produto.id}`,
        type: 'PUT',
        data: dados
    }).always(() => esconderModal());
}

/**
 * Busca todos os produtos.
 */
function buscar() {
    $.get("../back-end/produtos").done((response) => {
        produtos = JSON.parse(response);
        popular(produtos);
        buscarTipos();
    });
}

/**
 * Busca todos os tipos de produtos
 */
function buscarTipos() {
    $.get("../back-end/produtos/tipos").done(response => {
        tipos = JSON.parse(response);
        popularTipos(tipos);
    });
}

/**
 * Compara cada campo do formulário com um item do array
 * e verifica se são iguais.
 * 
 * @param {*} array - Um array de itens.
 * @param {*} formulario - Id do formulário.
 */
function compararForm(array, formulario) {
    $.each(array, function (campo, valor) {
        $(`#${formulario}`).find('select, input, textarea').each(function (index, formObj) {
            if (typeof valor === "object" && valor) {
                compararForm(valor, campo);
            }
            (campo === formObj.name) ? $(formObj).val(valor) : "";
        });
    });
}

/**
 * Cria um array de produtos.
 * 
 * @param {*} produtos - Array de produtos
 */
function popular(produtos) {
    $('#produtos_lista tr').remove();
    for (const produto of produtos) {
        var newRow = $(`<tr>`);
        var cols = "";
        cols += `<td class='item' id=${produto.id}>${produto.codigo}</td>`;
        cols += `<td class='item' id=${produto.id}>${produto.nome}</td>`;
        cols += `<td class='item' id=${produto.id}>${produto.tipo.descricao}</td>`;
        cols += `<td class='item' id=${produto.id}>${produto.descricao}</td>`;
        cols += `<td class='delete' id=${produto.id}><i class="fa fa-trash-o" style="color: red"></i></td>`
        newRow.append(cols);
        $("#produtos_lista").append(newRow)
    }
    $('.item').each((index, td) => {
        $(td).attr('onclick', `selecionarProduto(${td.id})`)
    });
    $('.delete').each((index, td) => {
        $(td).attr('onclick', `excluirProduto(${td.id})`)
    });
}

function excluirProduto(produtoId) {
    mostrarModal();
    $.ajax({
        url: `../back-end/produtos/${produtoId}`,
        type: 'DELETE'
    }).done(() =>
        buscar()
    ).always(() => esconderModal());
}

/**
 * Filtra um produto entre todos os produtos.
 * 
 * @param {*} produtoId - Id de um dos produtos.
 */
function selecionarProduto(produtoId) {
    produto = _.find(produtos, { 'id': `${produtoId}` });
    compararForm(produto, "produto");
}

/**
 * Cria o select com os tipos de produtos químicos.
 * 
 * @param {*} tipos - Array de tipos de produtos químicos
 */
function popularTipos(tipos) {
    $.each(tipos, function (index, tipo) {
        var option = '<option value="' + tipo.id + '">' + tipo.descricao + '</option>';
        $("#tipos").append(option)
    });
}

/**
 * UI
 */
function esconderModal() {
    $('#modal-default').modal('hide');
}

function mostrarModal() {
    $('#modal-default').modal({ backdrop: 'static', keyboard: false });

}
/**
 * FIM UI
 */
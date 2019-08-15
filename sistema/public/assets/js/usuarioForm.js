var query = location.search.slice(1);
var partes = query.split('&');
var data = {};
var usuario = {};

$(document).ready(() => {
    if (temQuery()) {
        partes.forEach(function (parte) {
            let chaveValor = parte.split('=');
            let chave = chaveValor[0];
            let valor = chaveValor[1];
            data[chave] = valor;
        });

        $.get(`../back-end/usuarios/${data.u}`).done(u => {
            usuario = JSON.parse(u);
            compararForm(JSON.parse(u), 'usuario');
        }).fail(error => console.log(error));
    }
});

$("#usuario").submit(() => {
    event.preventDefault();
    (temQuery()) ? atualizar() : cadastrar();
});

/**
 * Verifica se a variavel tem algum conteúdo
 */
const temQuery = () => (query) ? true : false;


/**
 * Compara os campos do formulário com as chaves
 * do objeto passado.
 * 
 * @param {*} dados - Dados a serem inseridos no formulário
 * @param {*} formulario - Formulário a ser preenchida
 */
const compararForm = (dados, formulario) => {
    $.each(dados, (campo, valor) => {
        form = $(`#${formulario}`).find("select, input, textarea");

        $(form).each((index, formObj) => {
            if (typeof valor === "object" && valor) {
                compararForm(valor, campo);
            }
            (formObj.name === campo) ? $(formObj).val(valor) : null;
        });
    });
}


function atualizar() {
    // mostrarModal();

    const a = $("#usuario").serializeArray();
    console.log(a);
    // $.ajax({
    //     type: "PUT",
    //     url: `../back-end/contratos/${contrato.id}`,
    //     data: dados
    // })
    //     .done(() => {
    //         alertCadastro();
    //         exibirSucesso();
    //         // window.location.href = "./contratosLista.php";
    //     })
    //     .always(() => esconderModal())
    //     .fail(() => exibirErro());
}

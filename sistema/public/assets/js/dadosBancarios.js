var banco = {};

function enviar() {
    var dados = $('#formulario').serialize();
    $.post("../back-end/banco", dados)
        .success(function (response) {
            cliente = JSON.parse(response)[0];
        });
}

function cadastrarBanco() {
    $(`#banco`).append(`<input hidden name='banco_id' value=${banco.id}>`);
    var dados = $("#contatos").serialize();

    $.post("../back-end/banco/banco", dados)
        .success(function (response) {
            contatos = JSON.parse(response);
            popularBanco(banco);
        });
}
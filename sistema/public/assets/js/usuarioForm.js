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


const atualizar = () => {
    let u = $("#usuario").serializeArray();
    u.push({ name: "id", value: usuario.id }, { name: "senha", value: usuario.senha });
    $.ajax({
        type: "PUT",
        url: `../back-end/usuarios/${usuario.id}`,
        data: u
    }).done(response => {
        usuario = JSON.parse(response);
        exibirSucesso();
    }).fail(() => exibirErro());
}

const cadastrar = () => {
    let u = $("#usuario").serializeArray();
    $.post(`../back-end/usuarios`, u)
        .done(response => {
            usuario = JSON.parse(response);
            exibirSucesso();
        }).fail(() => exibirErro());
}

const exibirSucesso = () => {
    $(`.success`).show("slow");
    setTimeout(() => $(".success").hide("slow"), 5000);
}

const exibirErro = () => {
    $(`#.erro`).show("slow");
    setTimeout(() => $(".erro").hide("slow"), 3000);
}

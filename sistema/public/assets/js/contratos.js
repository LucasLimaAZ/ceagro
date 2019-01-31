$(document).ready(() => {
    contrato = JSON.parse(localStorage.getItem('contrato'));
    $('.select2').select2();
    $("form.btn, .box-footer>.btn").text("Salvar");
    buscarProdutos();
    buscarUnidadesDeMedidas();
    buscarNumeroConfirmacao();
    buscarCfops();
    if (temContratoL()) {
        buscarAdendos();
        buscarFixacoes();
    }

});


$("#contrato").submit(() => {
    event.preventDefault();
    if (temContratoL()) {
        atualizar();
    } else {
        cadastrar();
    }
});

$("#adendo").submit(() => {
    event.preventDefault();
    if (temAdendo()) {
        atualizarAdendo();
    } else {
        cadastrarAdendo();
    }
});

$("#fixacao").submit(() => {
    event.preventDefault();
    if (temFixacao()) {
        atualizarFixacao();
    } else {
        cadastrarFixacao();
    }
});

let contrato = null;
let produtos = null;
let _adendos = null;
let _fixacoes = null;

let adendo = null;
let fixacao = null;
let numeros_confirmacao = null;

/**
 * Ao trocar de produto, filtra ele do array de produtos.
 */
$("#produtos").change((event) => {
    selecionarProduto(event.target.value);
})

/**
 * Exclui um adendo
 */
$("#deletarAdendo").on('click', () => {
    $("#modal-aviso").modal('hide');
    excluirAdendo();
});

/**
 * Exclui uma fixacao
 */
$("#deletarFixacao").on('click', () => {
    $("#modal-aviso-fixacoes").modal('hide');
    excluirFixacao();
});

$('.minimal[name="futuro"]').on('ifChecked', event => {
    event.target.value = (event.target.id == "f") ? 1 : 0;
    setNumeroConfirmacao();
});

function temContratoL() {
    return (contrato) ? true : false;
}

function temAdendo() {
    return (adendo) ? true : false;
}

function temFixacao() {
    return (fixacao) ? true : false;
}
/**
 * PRODUTOS
 */
function buscarProdutos() {
    $.get('../back-end/produtos')
        .done(response => {
            produtos = JSON.parse(response)
            popularProdutos(produtos);
        });
}

function popularProdutos(produtos) {
    $.each(produtos, (index, produto) => {
        const option = `<option value=${produto.id}>${produto.nome}</option>`;
        $("#produtos").append(option);
    })
}

function buscarCfops() {
    $.get(`../back-end/cfops`).done((response) => {
        cfops = JSON.parse(response);
        popularCfops(cfops)
    });
}
function popularCfops(cfops) {
    $.each(cfops, (index, cfop) => {
        const option = `<option value=${cfop.id}>${cfop.descricao}</option>`;
        $("#cfops").append(option);
    })
}

function selecionarProduto(produtoId) {
    produto = _.find(produtos, { "id": produtoId });
    popularDescricao(produto);
}

function popularDescricao(produto) {
    $("#descricao").val(produto.descricao);
}

/**
 * FIM PRODUTOS
 */

/**
 * UNIDADES DE MEDIDA
 */
function buscarUnidadesDeMedidas() {
    $.get('../back-end/unidades-medidas')
        .done(response => popularUnidadesMedidades(JSON.parse(response)));
}

function popularUnidadesMedidades(unidades) {
    $.each(unidades, (index, unidade) => {
        const option = `<option value=${unidade.id}>${unidade.titulo}</option>`;
        $("#unidades").append(option);
    });
}

/**
 * FIM UNIDADE DE MEDIDA
 */
/**
 * NUMERO CONFIRMACAO
 */
function buscarNumeroConfirmacao() {
    $.get('../back-end/numero-confirmacao').done(response => {
        numeros_confirmacao = JSON.parse(response);
        if (temContratoL()) {
            if (parseInt(contrato.futuro, 10)) {
                numeros_confirmacao[1] = contrato.numero_confirmacao;
            } else {
                numeros_confirmacao[0] = contrato.numero_confirmacao;
            }
        }
        setNumeroConfirmacao();
    })
}

function setNumeroConfirmacao() {
    if ($("input[name='futuro']:checked").val() == 1) {
        $(`:input[name='numero_confirmacao']`).val(numeros_confirmacao[1]);
    } else {
        $(`:input[name='numero_confirmacao']`).val(numeros_confirmacao[0]);
    }
}
/**
 * FIM NUMERO CONFIRMACAO
 */

function cadastrar() {
    mostrarModal();
    const dados = $("#contrato").serialize();
    $.post('../back-end/contratos', dados)
        .done(ct => {
            contrato = JSON.parse(ct);
            alertCadastro();
            exibirSucesso();
        })
        .always(() => esconderModal())
        .fail(() => exibirErro());
}

function atualizar() {
    mostrarModal();
    const dados = $("#contrato").serialize();
    $.ajax({ type: 'PUT', url: `../back-end/contratos/${contrato.id}`, data: dados })
        .done(() => {
            alertCadastro();
            exibirSucesso();
        })
        .always(() => esconderModal())
        .fail(() => exibirErro());
}
/** FIM CONTRATO */

/** ADENDOS */
function buscarAdendos() {
    $.get(`../back-end/contratos/${contrato.id}/adendos/`)
        .done(adendos => {
            _adendos = JSON.parse(adendos);
            listarAdendos(JSON.parse(adendos));
        });
}

function buscarFixacoes() {
    $.get(`../back-end/contratos/${contrato.id}/fixacoes`)
        .done(fixacoes => {
            _fixacoes = JSON.parse(fixacoes);
            listarFixacoes(JSON.parse(fixacoes));
        });
}

function cadastrarFixacao() {
    mostrarModal();
    $(`#fixacao`).append(`<input hidden name='contrato_id' value=${contrato.id}>`);
    const dados = $("#fixacao").serialize();
    $.post(`../back-end/contratos/fixacoes`, dados)
        .done(fixacoes => {
            _fixacoes = JSON.parse(fixacoes);
            exibirSucesso();
            listarFixacoes(_fixacoes);
        })
        .fail(() => exibirErro())
        .always(() => esconderModal());
}

function cadastrarAdendo() {
    mostrarModal();
    $(`#adendo`).append(`<input hidden name='contrato_id' value=${contrato.id}>`);
    const dados = $("#adendo").serialize();
    $.post(`../back-end/contratos/adendos`, dados)
        .done(adendos => {
            _adendos = JSON.parse(adendos);
            exibirSucesso();
            listarAdendos(_adendos);
        })
        .fail(() => exibirErro())
        .always(() => esconderModal());
}

function listarAdendos(adendos) {
    $('#adendos tr').remove();
    for (const adendo of adendos) {
        var newRow = $(`<tr>`);
        var cols = "";
        cols += `<td class='item' id=${adendo.id}>${adendo.descricao}</td>`;
        cols += `<td class="item" id=${adendo.id}>
            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-aviso">
                <i class="fa fa-trash-o" style="color: red"></i>
            </button>
        </td>`
        cols += `<td class="download" id=${adendo.id}>
            <button type="button" class="btn btn-default">
                <i class="fa fa-print" style="color: blue"></i>
            </button>
        </td>`
        newRow.append(cols);
        $("#adendos").append(newRow)
    }
    $('#adendos .item').each((index, td) => {
        $(td).attr('onclick', `selecionarAdendo(${td.id})`)
    });
    $(`#adendos .download`).on("click", () => {
        abrirAdendos(contrato.id);
    });
}

function listarFixacoes(fixacoes) {
    $('#fixacoes tr').remove();
    for (const fixacao of fixacoes) {
        var newRow = $(`<tr>`);
        var cols = "";
        cols += `<td class='item' id=${fixacao.id}>${fixacao.quantidade}</td>`;
        cols += `<td class='item' id=${fixacao.id}>${fixacao.preco}</td>`;
        cols += `<td class='item' id=${fixacao.id}>${fixacao.local_embarque}</td>`;
        cols += `<td class='item' id=${fixacao.id}>${fixacao.data_pagamento}</td>`;

        cols += `<td class='item' id=${fixacao.id}>${fixacao.contaBancaria.conta} | ${fixacao.contaBancaria.agencia} - ${fixacao.contaBancaria.banco}</td>`;
        cols += `<td class="item" id=${fixacao.id}>
            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-aviso-fixacoes">
                <i class="fa fa-trash-o" style="color: red"></i>
            </button>
        </td>`
        cols += `<td class="download" style="text-align:center" id="${fixacao.id}">
                    <button type="button" class="btn btn-default">
                        <i class="fa fa-print" style="color: blue"></i>
                    </button>
                </td>`
        newRow.append(cols);
        $("#fixacoes").append(newRow)
    }
    $('#fixacoes .item').each((index, td) => {
        $(td).attr('onclick', `selecionarFixacao(${td.id})`)
    });
    $(`#fixacoes .download`).on("click", () => {
        abrirFixacoes(contrato.id);
    });
}

function abrirFixacoes(ctId) {
    window.open(`../back-end/pdfs/contratos/${ctId}/fixacoes`, '_blank');
}
function abrirAdendos(ctId) {
    window.open(`../back-end/pdfs/contratos/${ctId}/adendos`, '_blank');
}

function selecionarFixacao(fixacaoId) {
    fixacao = _.find(_fixacoes, { 'id': `${fixacaoId}` });
    compararForm(fixacao, "fixacao");
}

function selecionarAdendo(adendoId) {
    adendo = _.find(_adendos, { 'id': `${adendoId}` });
    compararForm(adendo, "adendo");
}

function excluirFixacao() {
    mostrarModal();
    $.ajax({
        url: `../back-end/fixacoes/${fixacao.id}`,
        type: 'DELETE'
    }).done(() => {
        buscarFixacoes();
    }).always(() => esconderModal());
}

function excluirAdendo() {
    mostrarModal();
    $.ajax({
        url: `../back-end/adendos/${adendo.id}`,
        type: 'DELETE'
    }).done(() => {
        buscarAdendos();
    }).always(() => esconderModal());
}

function atualizarFixacao() {
    mostrarModal();
    $(`#fixacao`).append(`<input hidden name='contrato_id' value=${contrato.id}>`);
    $(`#fixacao`).append(`<input hidden name='id' value=${fixacao.id}>`);
    const dados = $("#fixacao").serialize();
    $.ajax({ type: 'PUT', url: `../back-end/fixacoes/${fixacao.id}`, data: dados })
        .done(fixacoes => {
            alertCadastro();
            exibirSucesso();
            buscarFixacoes();
        })
        .always(() => esconderModal())
        .fail(() => exibirErro());
}

function atualizarAdendo() {
    mostrarModal();
    $(`#adendo`).append(`<input hidden name='contrato_id' value=${contrato.id}>`);
    $(`#adendo`).append(`<input hidden name='id' value=${adendo.id}>`);
    const dados = $("#adendo").serialize();
    $.ajax({ type: 'PUT', url: `../back-end/adendos/${adendo.id}`, data: dados })
        .done(adendos => {
            alertCadastro();
            exibirSucesso();
            buscarAdendos();
        })
        .always(() => esconderModal())
        .fail(() => exibirErro());
}

/**
 * 
 */

function mostrarModal() {
    $('#modal-default').modal({ backdrop: 'static', keyboard: false });
}

function esconderModal() {
    $('#modal-default').modal('hide');
}

function alertCadastro() {
    $('.alert i').append("Cadastrado");
    $('.alert span').append("Cadastrado com sucesso!");
    $('.alert').show("fast", () => {
        setTimeout(() => {
            $('.alert').hide("slow");
        }, 5000);
    });
}


function exibirErro() {
    $(`#contrato .erro`).show("slow");
    setTimeout(() => {
        $(".erro").hide("slow");
    }, 2000);
}

function exibirSucesso() {
    $(`#contrato .success`).show("slow");
    setTimeout(() => {
        $(".success").hide("slow");
    }, 2000);
}

function compararForm(contrato, formulario) {
    $.each(contrato, function (campo, valor) {
        form = $(`#${formulario}`).find('select, input, textarea');
        $(form).each(function (index, formObj) {
            if (typeof valor === "object" && valor) {
                compararForm(valor, campo);
            }
            (formObj.name === campo) ? $(formObj).val(valor) : null;
        });
    });
}
$('.select2').select2();

$(document).ready(() => {
    buscarNumeroConfirmacao().
        $('.minimal[name="futuro"]').on('ifChecked', () => {
            setNumeroConfirmacao();
        });

    if (temContrato()) {
        numeros_confirmacao[1] = contrato.numero_confirmacao;
        $("input[name='futuro']:checked").val() == contrato.futuro;
        setNumeroConfirmacao();
    }
});

$("#contrato").submit(() => {
    event.preventDefault();
    if (temContrato()) {
        $(`#unidades`).val(contrato.unidade_medida_id);
        $(`#select2-unidades-container`).append(contrato.unidade_medida_id);
        atualizar();
    } else {
        cadastrar();
    }
});

numeros_confirmacao = [{}];

function temContrato() {
    if (contrato) {
        return true;
    }
    return false;
}

function compararContrato(contrato, formulario) {
    $.each(contrato, function (campo, valor) {
        $(`#${formulario}`).find('select, input, textarea').each(function (index, formObj) {
            if (typeof valor === "object" && valor) {

                compararContrato(valor, campo);
            }
            (formObj.name === campo) ? $(formObj).val(valor) : "";
        });
    });
}

function cadastrar() {
    $('#modal-default').modal({ backdrop: 'static', keyboard: false });
    numero_confirmacao = $(`:input[name='numero_confirmacao']`).val();
    $(`#contrato`).append(`<input hidden name='numero_confirmacao' value=${numero_confirmacao}>`);
    $(`#contrato`).append(`<input hidden name='comprador_id' value=${comprador.id}>`);
    $(`#contrato`).append(`<input hidden name='vendedor_id' value=${vendedor.id}>`);
    $(`#contrato`).append(`<input hidden name='produto_id' value=${produto.id}>`);
    $(`#contrato`).append(`<input hidden name='vendedor_conta_bancaria_id' value=${conta.id}>`);
    var dados = $('#contrato').serialize();
    $.post('../back-end/contratos', dados, () => {
        alertCadastro();
    });
}

function alertCadastro() {
    $('#modal-default').modal('hide');
    $('.alert i').append("Cadastrado");
    $('.alert span').append("Cadastrado com sucesso!");
    $('.alert').show("fast", () => {
        setTimeout(() => {
            $('.alert').hide("slow");
        }, 5000);
    });
}

function alertAtualizar() {
    $('#modal-default').modal('hide');
    $('.alert i').append("Atualizado");
    $('.alert span').append("Atualizado com sucesso!");
    $('.alert').show("fast", () => {
        setTimeout(() => {
            $('.alert').hide("slow");
        }, 5000);
    });
}

function atualizar() {
    numero_confirmacao = $(`:input[name='numero_confirmacao']`).val();
    $(`#contrato`).append(`<input hidden name='numero_confirmacao' value=${numero_confirmacao}>`);
    $('#modal-default').modal({ backdrop: 'static', keyboard: false });
    $(`#contrato`).append(`<input hidden name='comprador_id' value=${comprador.id}>`);
    $(`#contrato`).append(`<input hidden name='vendedor_id' value=${vendedor.id}>`);
    $(`#contrato`).append(`<input hidden name='vendedor_conta_bancaria_id' value=${conta.id}>`);
    $(`#contrato`).append(`<input hidden name='produto_id' value=${produto.id}>`);
    var dados = $('#contrato').serialize();
    $.ajax({
        url: `../back-end/contratos/${contrato.id}`,
        type: 'PUT',
        data: dados,
        success: function () {
            alertAtualizar();
        }
    });
}

function buscarNumeroConfirmacao() {
    $.ajax({
        url: `../back-end/numero-confirmacao`,
        type: "get",
        dataType: "json",
        success: response => {
            numeros_confirmacao = response;
            setNumeroConfirmacao();
        }
    });
}

function setNumeroConfirmacao() {
    if ($("input[name='futuro']:checked").val() == 1) {
        $(`:input[name='numero_confirmacao']`).val(numeros_confirmacao[1]);
    } else {
        $(`:input[name='numero_confirmacao']`).val(numeros_confirmacao[0]);
    }
}

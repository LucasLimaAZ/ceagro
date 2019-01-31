$("document").ready(() => {
    buscar();
});

cfop = null;
$("#deletar").on('click', () => {
    deletar();
});
$("#cfop").submit(function (event) {
    event.preventDefault();
    if (cfop) {
        atualizar()
    } else {
        cadastrar()
    }
});

function cadastrar() {
    var dados = $("#cfop").serialize();

    $.post("../back-end/cfops", dados)
        .done(() => {
            buscar();
        }).always(() => compararForm({ descricao: '' }, 'cfop'));
}

function atualizar() {
    $(`#cfop`).append(`<input hidden name='cfopid' value=${cfop.id}>`);
    var dados = $('#cfop').serialize();
    $.ajax({
        url: `../back-end/cfops/${cfop.id}`,
        type: 'PUT',
        data: dados
    }).done(() => buscar())
        .always(() => {
            compararForm({ descricao: '' }, 'cfop');
            cfop = null;
        });
}

function buscar() {
    $.get(`../back-end/cfops`).done((response) => {
        cfops = JSON.parse(response);
        popular(cfops)
    });
}

function popular(cps) {
    $('#cfops tr').remove();
    for (const cp of cps) {
        var newRow = $(`<tr class='item' id=${cp.id}>`);
        var cols = "";
        cols += `<td>${cp.descricao}</td>`;
        cols += `<td class="delete" style="text-align:center" id="${cp.id}">
        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-aviso">
            <i class="fa fa-trash-o" style="color: red"></i>
        </button>
    </td>`;
        newRow.append(cols);
        $("#cfops").append(newRow)
    }
    $('#cfops tr').each((index, linha) => {
        $(linha).attr('onclick', `selecionar(${linha.id})`);
    });
}

function selecionar(cfopId) {
    cfop = _.find(cfops, { 'id': `${cfopId}` });
    compararForm(cfop, 'cfop');
}

function deletar() {
    $.ajax({
        url: `../back-end/cfops/${cfop.id}`,
        type: 'DELETE'
    }).done(() =>
        buscar()
    ).always(() => {
        compararForm({ descricao: '' }, 'cfop');
    });
}

function compararForm(cliente, formulario) {
    $.each(cliente, function (campo, valor) {
        $(`#${formulario}`).find('select, input, textarea').each(function (index, formObj) {
            if (typeof valor === "object" && valor) {
                compararForm(valor, campo);
            }
            if (campo == formObj.name) {
            }
            (campo === formObj.name) ? $(formObj).val(valor) : "";
        });
    });
}
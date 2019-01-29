clienteId = null

$("#deletarCliente").on('click', () => {
    $("#modal-default").modal('hide');
    deletarCliente();
});

function buscar() {
    $.get("../back-end/clientes").done(response => {
        clientes = JSON.parse(response);
        popularPesquisa(clientes, () => {
            $(".overlay").remove();
            table = $('#clientes').DataTable();
        });
    });
}

function popularPesquisa(clientes, callback) {
    $("#clientes tbody tr").remove();

    $.each(clientes, (index, cliente) => {
        if (cliente.unidades.length > 0) {
            popularPorUnidade(cliente);
        }
    });

    $(`#clientes .item`).on("click", () => {
        irParaCliente(this.id);
    });

    $(`#clientes .delete`).on("click", () => {
        selecionarCliente(this.id);
    });
    callback();
}

function popularPorUnidade(cliente) {
    $.each(cliente.unidades, (index, unidade) => {
        var linha = `<tr id="${cliente.id}" class="clicavel ${cliente.id}">
                <td class="item" id="${cliente.id}">${cliente.nome_fantasia || 'Não há Registros'}</td>
                <td class="item" id="${cliente.id}">${unidade.razao_social}</td>
                <td class="item" id="${cliente.id}">${unidade.cnpj || 'Não há Registros'}</td>
                <td class="item" id="${cliente.id}">${unidade.inscricao_estadual || 'Não há Registros'}</td>
                <td class="item" id="${cliente.id}">${(unidade.endereco) ? unidade.endereco.cidade : 'Não há Registros'}</td>
                <td class="delete" style="text-align:center" id="${cliente.id}">
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-aviso">
                        <i class="fa fa-trash-o" style="color: red"></i>
                    </button>
                </td>
            </tr>`;
        $("#clientes tbody").append(linha);
    });
}

function irParaCliente(cliente) {
    $.get(`../back-end/clientes/${cliente}`, function (response) {
        cliente = JSON.parse(response);
        localStorage.setItem('cliente', JSON.stringify(cliente));
        $(location).attr('href', 'clientes.php');
    });
}

function selecionarCliente(clId) {
    clienteId = clId;
}

function deletarCliente() {
    mostrarModal();
    $.ajax({
        url: `../back-end/clientes/${clienteId}`,
        type: 'DELETE'
    }).done(() =>
        table.rows($(`.${clienteId}`)).remove().draw()
    ).always(() => esconderModal());
}

/**
 * UI
 */
function esconderModal() {
    $('#modal-aviso').modal('hide');
}

function mostrarModal() {
    $('#modal-aviso').modal({ backdrop: 'static', keyboard: false });

}

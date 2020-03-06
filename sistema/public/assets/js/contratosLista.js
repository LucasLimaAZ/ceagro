var contratoId = null;
var table = null;
var contratos = [];
var contratosAnteriores = [];
var contratosFuturos = [];
var contratosPassados = [];

$(document).ready(() => {
  buscarContratos();
  $("#btn-atuais").click(() => {
    criarTabelaContratos(contratosAnteriores);
    addClassBtn("atuais");
    removeClassBtn("futuros");
    removeClassBtn("passados");
  });

  $("#btn-passados").click(() => {
    criarTabelaContratos(contratosPassados);
    addClassBtn("passados");
    removeClassBtn("atuais");
    removeClassBtn("futuros");
  });

  $("#btn-futuros").click(() => {
    criarTabelaContratos(contratosFuturos);
    addClassBtn("futuros");
    removeClassBtn("atuais");
    removeClassBtn("passados");
  });
});

$("#deletarContrato").on("click", () => {
  $("#modal-default").modal("hide");
  deletarContrato();
});

function addClassBtn(btn) {
  $("#btn-" + btn).removeClass('btn-flat').addClass("btn-primary");
}

function removeClassBtn(btn) {
  $("#btn-" + btn).removeClass('btn-primary').addClass("btn-flat");
}

function buscarContratos() {
  let r;
  $.get(`../back-end/contratos`).done(response => {
    contratos = JSON.parse(response);
    contratosAnteriores = contratos.filter((elem, index, arr) => elem.futuro == 0);
    contratosFuturos = contratos.filter((elem, index, arr) => elem.futuro == 1);
    contratosPassados = contratos.filter((elem, index, arr) => elem.futuro == 2);
    $("#btn-atuais").removeClass('btn-flat').addClass("btn-primary");
    criarTabelaContratos(contratosAnteriores);
  });
}

function criarTabelaContratos(array) {
  if (table) {
    table.destroy();
  }
  popularPesquisa(array, () => {
    $(".overlay").remove();
    table = $("#contratos").DataTable({
      "language": languagePT,
      "ordering": false
    });

  });
}

function popularPesquisa(contratos, callback = null) {
  $("#contratos tbody tr").remove();
  $.each(contratos, (index, contrato) => {
    var linha = `<tr id="${contrato?.id}" class="clicavel">
            <td class="item" id="${contrato?.id}">${
      contrato?.numero_confirmacao
      }</td>
            <td class="item" id="${contrato?.id}">${contrato?.unidadeComprador
        ?.razao_social || "-"}</td>
            <td class="item" id="${contrato?.id}">${
      contrato?.unidadeVendedor.razao_social || "-"
      }</td>
            <td class="item" id="${contrato?.id}">${contrato?.produto.nome}</td>
            <td class="download" style="text-align:center" id="${contrato?.id}">
                <button type="button" class="btn btn-primary" id="${
      contrato?.id
      }">
                    <i class="fa fa-print" id="${contrato?.id}"></i>
                </button>
            </td>
            <td class="delete" style="text-align:center" id="${contrato?.id}">
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-aviso">
                    <i class="fa fa-trash-o" ></i>
                </button>
            </td>
        </tr>`;

    $("#contratos tbody").append(linha);
  });
  $(`#contratos .item`).on("click", function () {
    irParaContratos(this.id);
  });
  $(`#contratos .download`).on("click", function (event) {
    abrirContrato(event.target.id);
  });
  $(`#contratos .delete`).on("click", function () {
    selecionarContrato(this.id);
  });
  callback ? callback() : "";
}

function selecionarContrato(ctId) {
  contratoId = ctId;
}

function abrirContrato(ctId) {
  window.open(`../back-end/pdfs/contratos/${ctId}`, "_blank");
}

function irParaContratos(contrato) {
  $.get(`../back-end/contratos/${contrato}/`, response => {
    contrato = JSON.parse(response);
    localStorage.setItem("contrato", JSON.stringify(contrato));
    $(location).attr("href", "contratos.php");
  });
}

function deletarContrato() {
  mostrarModal();
  $.ajax({
    url: `../back-end/contratos/${contratoId}`,
    type: "DELETE"
  })
    .done(() =>
      table
        .row($(`#${contratoId}`))
        .remove()
        .draw()
    )
    .always(() => esconderModal());
}

/**
 * UI
 */
function esconderModal() {
  $("#modal-aviso").modal("hide");
}

function mostrarModal() {
  $("#modal-aviso").modal({ backdrop: "static", keyboard: false });
}


const languagePT = {
  'sEmptyTable': 'Nenhum registro encontrado',
  'sInfo': 'Mostrando de _START_ até _END_ de _TOTAL_ registros',
  'sInfoEmpty': 'Mostrando 0 até 0 de 0 registros',
  'sInfoFiltered': '(Filtrados de _MAX_ registros)',
  'sInfoPostFix': '',
  'sInfoThousands': '.',
  'sLengthMenu': 'Exibir _MENU_ resultados por página',
  'sLoadingRecords': 'Carregando...',
  'sProcessing': 'Processando...',
  'sZeroRecords': 'Nenhum registro encontrado',
  'sSearch': 'Pesquisar',
  'oPaginate': {
    'sNext': 'Próximo',
    'sPrevious': 'Anterior',
    'sFirst': 'Primeiro',
    'sLast': 'Último'
  },
  'oAria': {
    'sSortAscending': ': Ordenar colunas de forma ascendente',
    'sSortDescending': ': Ordenar colunas de forma descendente'
  }
};
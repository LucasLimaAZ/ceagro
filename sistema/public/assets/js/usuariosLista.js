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

var table = null;
var usuarios = [];

$(document).ready(() => buscarUsuarios() );

$("#deletarUsuario").on("click", () => {
  $("#modal-default").modal("hide");
  deletarUsuario();
});

const exibirErro = () => {
  $(`.erro-load`).show("slow");
  setTimeout(() => $(".erro-load").hide("slow"), 2000);
}

const buscarUsuarios = () => {
  $.get(`../back-end/usuarios`)
  .done(response => {
    usuarios = JSON.parse(response);
    criarTabelaUsuarios(usuarios);
  })
  .fail(() => exibirErro())
  .always(() => $(".overlay").remove());
}

function criarTabelaUsuarios(array) {
  if (table) {
    table.destroy();
  }

  popularPesquisa(array, () => {
    $(".overlay").remove();
    table = $("#usuarios").DataTable({
      "language": languagePT,
      "ordering": false
    });
  });
}

function popularPesquisa(usuarios, callback = null) {
  $("#usuarios tbody tr").remove();
  $.each(usuarios, (index, usuario) => {
    var linha = `
    <tr id="${usuario.id}" class="clicavel">
            <td class="item" id="${ usuario.id }">${ usuario.nome }</td>
            <td class="item" id="${ usuario.id }">${ usuario.login || "-" }</td>
            <td class="item" id="${ usuario.id }">${ usuario.password || "-" }</td>
            <td class="edit" style="text-align:center" id="${usuario.id}">
                <button type="button" class="btn btn-primary" id="${ usuario.id }">
                    <i class="fa fa-pencil" id="${usuario.id}"></i>
                </button>
            </td>
            <td class="delete" style="text-align:center" id="${usuario.id}">
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-aviso">
                    <i class="fa fa-trash-o" ></i>
                </button>
            </td>
        </tr>`;

    $("#usuarios tbody").append(linha);
  });
  $(`#usuarios .item`).on("click", function () {
    irParaUsuario(this.id);
  });
  $(`#usuarios .edit`).on("click", function (event) {
    abrirContrato(event.target.id);
  });
  $(`#usuarios .delete`).on("click", function () {
    selecionarUsuario(this.id);
  });
  callback ? callback() : "";
}

const selecionarUsuario = (ctId) => usuarioId = ctId;


const abrirContrato = (ctId) =>  window.location.href = `usuarioForm.php?u=${ctId}`;

const irParaUsuario = (usuario) => {
  $.get(`../back-end/usuarios/${usuario}/`, response => {
    usuario = JSON.parse(response);
    localStorage.setItem("usuario", JSON.stringify(usuario));
    $(location).attr("href", "usuarios.php");
  });
}

const deletarUsuario = () => {
  mostrarModal();
  $.ajax({
    url: `../back-end/usuarios/${usuarioId}`,
    type: "DELETE"
  })
    .done(() =>
      table
        .row($(`#${usuarioId}`))
        .remove()
        .draw()
    )
    .always(() => esconderModal());
}

/**
 * UI
 */
const esconderModal = () => $("#modal-aviso").modal("hide");
const mostrarModal = () => $("#modal-aviso").modal({ backdrop: "static", keyboard: false });

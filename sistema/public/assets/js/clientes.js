var cliente = null;
var unidade = null;
var enderecos = [];
var conta = null;

function temCliente() {
  return cliente ? true : false;
}

function temUnidade() {
  return unidade ? true : false;
}

function temEndereco() {
  return endereco ? true : false;
}

function temConta() {
  return conta ? true : false;
}

/**
 * AJAX
 */

/**
 * Verifica se há um cliente no localStorage
 * caso haja ele pega esse cliente e depois excluí do
 * localStorage
 */
$(document).ready(() => {
  $("#und").hide();
  if (localStorage.hasOwnProperty("cliente")) {
    cliente = JSON.parse(localStorage.getItem("cliente"));
    localStorage.removeItem("cliente");

    buscarContas(cliente.id, () => {
      compararFormCliente(cliente, "cliente");
    });

    buscarEnderecos(cliente.id);

    buscarUnidades(cliente.id);
  } else {
    desabilitarForm();
  }
});

/**
 * Adiciona o texto: Salvar a todos os botões
 */
$(".btn").text("Salvar");
$(".btn-danger").text("Fechar");
$("#deletarUnidade").text("Excluir");
$("#deletarEndereco").text("Excluir");
$("#deletarConta").text("Excluir");
/**
 * Verifica se há cliente, caso haja
 * atualiza, do contrário, cadastra um.
 */
$("#cliente").submit(function(event) {
  event.preventDefault();
  temCliente() ? atualizar() : cadastrar();
});

/**
 * Verifica se há uma unidade, caso haja
 * atualiza, do contrário, cadastra uma.
 */
$("#unidade").submit(function(event) {
  event.preventDefault();
  temUnidade() ? atualizarUnidade() : cadastrarUnidade();
});

/**
 * Ao clicar no botão da modal.
 */
$("#deletarUnidade").on("click", () => {
  deletarUnidade();
});

$("#deletarEndereco").on("click", () => {
  deletarEndereco();
});
$("#deletarConta").on("click", () => {
  deletarConta();
});
/**
 * Verifica se há cliente, caso haja
 * atualiza o endereço, do contrário, cadastra um.
 */
$("#endereco").submit(function(event) {
  event.preventDefault();
  if (temUnidade()) {
    temEndereco() && unidade.endereco != null
      ? atualizarEndereco()
      : cadastrarEndereco();
  } else {
    mostrarSemUnidade();
  }
});

/**
 * Verifica se há cliente, caso haja
 * atualiza o endereço, do contrário, cadastra um.
 */
$("#contasBancarias").submit(function(event) {
  event.preventDefault();
  temConta() ? atualizarContaBancaria() : cadastrarContaBancaria();
});

/**
 *  FIM AJAX
 */

/**
 * Habilita todos os campos dos formulários;
 */
function habilitarForm() {
  $(`form *`).prop("disabled", false);
  $(`.btn`).prop("disabled", false);
}

/**
 * Desabilita todos os campos dos formulários com exceção de cliente;
 */
function desabilitarForm() {
  $("form *").prop("disabled", true);
  $(".btn").prop("disabled", true);
  $("#cliente *").prop("disabled", false);
  // $("#endereco *").prop("disabled", false);
}

/**
 * Preenche o formulário de acordo com o objeto passado.
 *
 * @param {object} cliente
 * @param {dom element} formulario
 */
function compararFormCliente(cliente, formulario) {
  $.each(cliente, function(campo, valor) {
    $(`#${formulario}`)
      .find("select, input, textarea")
      .each(function(index, formObj) {
        if (typeof valor === "object" && valor) {
          compararFormCliente(valor, campo);
        }
        campo === formObj.name ? $(formObj).val(valor) : "";
      });
  });
}

/**
 * Busca as unidades do cliente.
 *
 * @param {int} clienteId - Id do cliente.
 */
function buscarUnidades(clienteId) {
  $.get(`../back-end/clientes/${clienteId}/unidades`, function(response) {
    cliente.unidades = JSON.parse(response);
  })
    .done(() => {
      popularUnidades(cliente.unidades);
    })
    .always(() => esconderModal())
    .fail(() => exibirErro("unidade"));
}

/**
 * Busca o endereço do cliente.
 *
 * @param {*} clienteId - Id do cliente.
 * @param {*} callback - Callback para poder realizar uma ação após o término do processo.
 */
function buscarEnderecos(clienteId) {
  $.get(`../back-end/clientes/${clienteId}/enderecos`).done(end => {
    enderecos = JSON.parse(end);
    popularEnderecos(JSON.parse(end));
  });
}

/**
 * Busca as contas bancárias do cliente.
 *
 *
 * @param {*} clienteId - Id do cliente.
 * @param {*} callback - Um callback para realizar uma ação após o término da função.
 */
function buscarContas(clienteId, callback = null) {
  $.get(`../back-end/clientes/${clienteId}/contas-bancarias`, function(
    response
  ) {
    cliente.contasBancarias = JSON.parse(response);
    popularContas(cliente.contasBancarias);
    if (callback) {
      callback();
    }
  });
}

/**
 * Preenche a tabela de unidades e atribui o click a cada linha.
 *
 * @param {Array} unidades - Array de unidades do cliente.
 */
function popularUnidades(unidades) {
  $("#unidades tr").remove();
  var i = 1;
  for (const unidade of unidades) {
    var newRow = $(`<tr class='item' id=${unidade.id}>`);
    var cols = "";
    cols += `<td>${i++}</td>`;
    cols += `<td>${unidade.cnpj}</td>`;
    cols += `<td>${unidade.inscricao_estadual}</td>`;
    cols += `<td>${unidade.razao_social}</td>`;
    cols += `<td>${unidade.razao_social}</td>`;
    cols += `<td class="delete" style="text-align:center" id="${unidade.id}">
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-aviso">
            <i class="fa fa-trash-o"></i>
        </button>
    </td>`;
    newRow.append(cols);
    $("#unidades").append(newRow);
  }
  $("#unidades tr").each((index, linha) => {
    $(linha).attr("onclick", `selecionarUnidade(${linha.id})`);
    $(linha).click(() => {
      $(".item").toggleClass("ativado", false);
      $(`#${linha.id}`).toggleClass("ativado", true);
    });
  });
}
function popularEnderecos(enderecos) {
  $("#enderecos tr").remove();
  var counterEndereco = 1;
  for (const endereco of enderecos) {
    var newRow = $(`<tr class='item' id=${endereco.id}>`);
    var cols = "";
    cols += `<td>${counterEndereco++}</td>`;
    cols += `<td>${endereco.estado}</td>`;
    cols += `<td>${endereco.cidade}</td>`;
    cols += `<td>${endereco.rua}</td>`;
    cols += `<td>${endereco.cep}</td>`;
    cols += `<td class="delete" style="text-align:center" data-toggle="modal" data-target="#modal-endereco"">
        <button type="button" class="btn btn-danger" >
            <i class="fa fa-trash-o"></i>
        </button>
    </td>`;
    newRow.append(cols);
    $("#enderecos").append(newRow);
  }
  $("#enderecos tr").each((index, linha) => {
    $(linha).attr("onclick", `selecionarEndereco(${linha.id})`);
  });
}

function deletarEndereco() {
  esconderModalEndereco();
  mostrarModal();
  limparCamposUnidade();
  $.ajax({
    url: `../back-end/enderecos/${endereco.id}`,
    type: "DELETE"
  })
    .done(() => buscarEnderecos(cliente.id))
    .always(() => {
      esconderModal();
      unidade = null;
    });
}

/**
 * Atualiza a unidade do cliente.
 */
function atualizarUnidade() {
  mostrarModal();

  $(`#unidade`).append(`<input hidden name='cliente_id' value=${cliente.id}>`);
  dados = $("#unidade").serialize();

  $.ajax({
    url: `../back-end/unidades/${unidade.id}`,
    type: "PUT",
    data: dados
  })
    .done(() => {
      exibirSucesso("unidade");
      unidade = null;
      limparCamposUnidade();
      buscarUnidades(cliente.id);
    })
    .fail(() => exibirErro("unidade"))
    .always(() => esconderModal());
}

/**
 * Limpa os campos do formulário de unidade.
 */
function limparCamposUnidade() {
  $("#unidade :input").each((index, field) => {
    $(field).val("");
  });
  return;
}

function limparCamposContas() {
  $("#contasBancarias :input").each((index, field) => {
    $(field).val("");
  });
  return;
}

function limparCamposEndereco() {
  endereco = null;
  $("#endereco :input").each((index, field) => {
    $(field).val("");
  });
  return;
}

/**
 * Popula o formulário com uma unidade escolhida.
 *
 * @param {Object} unidade - Unidade do estabelecimento.
 */
function popularUnidade(unidadeCliente) {
  unidade = unidadeCliente;
  compararFormCliente(unidadeCliente, "unidade");
}

function popularEndereco(enderecoUnidade) {
  endereco = enderecoUnidade;
  compararFormCliente(enderecoUnidade, "endereco");
}

/**
 * Seleciona uma unidade no array de unidades
 *
 * @param {*} unidadeId - Id da unidade do estabelecimento.
 */
function selecionarUnidade(unidadeId) {
  const unidade = _.find(cliente.unidades, { id: `${unidadeId}` });
  unidade.endereco
    ? selecionarEndereco(unidade.endereco.id)
    : limparCamposEndereco();
  popularUnidade(unidade);
}

function selecionarEndereco(enderecoId) {
  const endereco = _.find(enderecos, { id: `${enderecoId}` });
  popularEndereco(endereco);
}

/**
 * Cria uma tabela com as contas bancárias.
 *
 * @param {*} contas - Array de contas bancárias.
 */
function popularContas(contas) {
  $("#contas_bancarias tr").remove();
  for (const conta of contas) {
    var newRow = $(`<tr class='item' id=${conta.id}>`);
    var cols = "";
    cols += `<td>${conta.banco}</td>`;
    cols += `<td>${conta.agencia}</td>`;
    cols += `<td>${conta.conta}</td>`;
    cols += `<td class="delete" style="text-align:center; width:5%" id="${
      conta.id
    }">
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-conta">
            <i class="fa fa-trash-o"></i>
        </button>
    </td>`;
    newRow.append(cols);
    $("#contas_bancarias").append(newRow);
  }
  $("#contas_bancarias tr").each((index, linha) => {
    $(linha).attr("onclick", `selecionarContaBancaria(${linha.id})`);
  });
}

/**
 * Atualiza a conta do cliente.
 */
function atualizarContaBancaria() {
  mostrarModal();
  $(`#contasBancarias`).append(
    `<input hidden name='cliente_id' value=${cliente.id}>`
  );
  $(`#contasBancarias`).append(
    `<input hidden name='id' id=${conta.id} value=${conta.id}>`
  );
  dados = $("#contasBancarias").serialize();
  $.ajax({
    url: `../back-end/contas-bancarias/${conta.id}`,
    type: "PUT",
    data: dados
  })
    .done(() => {
      limparCamposUnidade();
      exibirSucesso("contasBancarias");
      buscarContas(cliente.id);
      $(`#contasBancarias input#${conta.id}`).remove();
    })
    .fail(() => exibirErro("contasBancarias"))
    .always(() => {
      esconderModal();
      conta = null;
    });
}

/**
 * Seleciona uma conta no array de contas
 *
 * @param {*} contaId - Id da conta do cliente.
 */
function selecionarContaBancaria(contaId) {
  const conta = _.find(cliente.contasBancarias, { id: `${contaId}` });
  popularConta(conta);
}

/**
 * Popula o formulário com uma conta escolhida.
 *
 * @param {Object} conta - Unidade do estabelecimento.
 */
function popularConta(contasBancarias) {
  conta = contasBancarias;
  compararFormCliente(contasBancarias, "contasBancarias");
}

/**
 *
 * Cadastros e Updates
 */

/**
 * Cadastra um cliente.
 */
function cadastrar() {
  mostrarModal();
  var dados = $("#cliente").serialize();
  $.post("../back-end/clientes", dados, response => {
    cliente = JSON.parse(response);
  })
    .done(() => {
      habilitarForm();
      exibirSucesso("cliente");
    })
    .always(() => esconderModal())
    .fail(() => exibirErro("cliente"));
}

/**
 * Cadastra uma unidade para o cliente.
 */
function cadastrarUnidade() {
  mostrarModal();
  $(`#unidade`).append(`<input hidden name='cliente_id' value=${cliente.id}>`);
  var dados = $("#unidade").serialize();

  $.post("../back-end/unidades", dados)
    .done(und => {
      exibirSucesso("unidade");
      buscarUnidades(cliente.id);
      limparCamposUnidade();
      unidade = null;
    })
    .always(() => esconderModal())
    .fail(() => exibirErro("unidade"));
}

/**
 * Deleta uma unidade
 */
function deletarUnidade() {
  esconderModalAviso();
  mostrarModal();
  limparCamposUnidade();
  $.ajax({
    url: `../back-end/unidades/${unidade.id}`,
    type: "DELETE"
  })
    .done(() => buscarUnidades(cliente.id))
    .always(() => {
      esconderModal();
      unidade = null;
    });
}
function deletarConta() {
  esconderModalAviso();
  mostrarModal();
  limparCamposContas();
  $.ajax({
    url: `../back-end/contas-bancarias/${conta.id}`,
    type: "DELETE"
  })
    .done(() => buscarContas(cliente.id))
    .always(() => {
      esconderModal();
      conta = null;
    });
}

/**
 * Cadastra o endereço da unidade.
 */
function cadastrarEndereco() {
  mostrarModal();
  $(`#endereco`).append(`<input hidden name='unidade_id' value=${unidade.id}>`);
  $(`#endereco`).append(`<input hidden name='cliente_id' value=${cliente.id}>`);
  var dados = $("#endereco").serialize();

  $.post("../back-end/clientes/enderecos", dados)
    .done(() => {
      exibirSucesso("endereco");
      endereco = null;
      buscarEnderecos(cliente.id);
    })
    .always(() => esconderModal())
    .fail(() => exibirErro("endereco"));
}

/**
 * Cadastra uma conta bancária.
 */
function cadastrarContaBancaria() {
  $(`#contasBancarias`).append(
    `<input hidden name='cliente_id' value=${cliente.id}>`
  );
  mostrarModal();
  var dados = $("#contasBancarias").serialize();
  $.post(`../back-end/clientes/contas-bancarias`, dados)
    .fail(() => exibirErro("contasBancarias"))
    .done(() => {
      buscarContas(cliente.id);
      exibirSucesso("contasBancarias");
    })
    .always(() => {
      esconderModal();
    });
}

/**
 * Atualiza um cliente.
 */
function atualizar() {
  mostrarModal();
  var dados = $("#cliente").serialize();
  $.ajax({
    url: `../back-end/clientes/${cliente.id}`,
    type: "PUT",
    data: dados
  })
    .done(() => exibirSucesso("cliente"))
    .fail(() => exibirErro("cliente"))
    .always(() => esconderModal());
}

/**
 * Atualiza o endereco do cliente.
 */
function atualizarEndereco() {
  mostrarModal();
  $(`#endereco`).append(`<input hidden name='cliente_id' value=${cliente.id}>`);
  $(`#endereco`).append(`<input hidden name='id' value=${endereco.id}>`);
  $(`#endereco`).append(`<input hidden name='unidade_id' value=${unidade.id}>`);
  var dados = $("#endereco").serialize();
  $.ajax({
    url: `../back-end/clientes/enderecos/${endereco.id}`,
    type: "PUT",
    data: dados
  })
    .always(() => {
      esconderModal();
      limparCamposEndereco();
    })
    .done(() => {
      exibirSucesso("endereco");
      buscarEnderecos(cliente.id);
      $(`#endereco input#${endereco.id}`).remove();
      endereco = null;
    })
    .fail(() => exibirErro("endereco"));
}

function exibirErro(form) {
  $(`#${form} .erro`).show("slow");
  setTimeout(() => {
    $(".erro").hide("slow");
  }, 3000);
}

function exibirSucesso(form) {
  $(`#${form} .success`).show("slow");
  setTimeout(() => {
    $(".success").hide("slow");
  }, 5000);
}

function mostrarSemUnidade() {
  $(`#endereco .warning#und`).show("slow");
  setTimeout(() => {
    $(".warning").hide("slow");
  }, 5000);
}

function esconderModal() {
  $("#modal-default").modal("hide");
}
function esconderModalAviso() {
  $("#modal-aviso").modal("hide");
}
function esconderModalEndereco() {
  $("#modal-endereco").modal("hide");
}

function mostrarModal() {
  $("#modal-default").modal({ backdrop: "static", keyboard: false });
}

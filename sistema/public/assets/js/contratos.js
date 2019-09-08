$(document).ready(() => {
  contrato = JSON.parse(localStorage.getItem("contrato"));
  $(".select2").select2();
  $("form.btn, .box-footer>.btn").text("Salvar");
  buscarProdutos();
  buscarUnidadesDeMedidas();
  buscarNumeroConfirmacao();
  buscarCfops();
  if (temContratoL()) {
    buscarAdendos();
    buscarFixacoes();
  }

  setTimeout(() => {
    if (exists($("#data_embarque_final").val())) {
      $("#data_embarque_final").val(
        moment($("#data_embarque_final").val(), "YYYY-MM-DD").format("DD/MM/YYYY")
      );
    }

    if ($("#data_embarque_inicial").val()) {
      $("#data_embarque_inicial").val(
        moment($("#data_embarque_inicial").val(), "YYYY-MM-DD").format(
          "DD/MM/YYYY"
        )
      );
    }

    verificarImediato();
  }, 1500);
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

$("#imediato").change(() => {
  verificarImediato();
});

desabilitarDatasPicker = () => {
  $("#data_embarque_inicial").prop("readonly", true);
  $("#data_embarque_final").prop("readonly", true);
  $("#data_embarque_inicial").datepicker("destroy");
  $("#data_embarque_final").datepicker("destroy");
  $("#data_embarque_inicial").val(null);
  $("#data_embarque_final").val(null);
};

habilitarDatasPicker = () => {
  $("#data_embarque_inicial").prop("readonly", false);
  $("#data_embarque_final").prop("readonly", false);
  $("#data_embarque_inicial").datepicker();
  $("#data_embarque_final").datepicker();
  $("#data_embarque_inicial").val(null);
  $("#data_embarque_final").val(null);
};

verificarImediato = () => {
  if ($("#imediato").is(":checked")) {
    desabilitarDatasPicker();
  } else {
    habilitarDatasPicker();
  }
};

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
let dados = {};
let contratoArray;

/**
 * Ao trocar de produto, filtra ele do array de produtos.
 */
$("#produtos").change(event => {
  selecionarProduto(event.target.value);
});

/**
 * Exclui um adendo
 */
$("#deletarAdendo").on("click", () => {
  $("#modal-aviso").modal("hide");
  excluirAdendo();
});

/**
 * Exclui uma fixacao
 */
$("#deletarFixacao").on("click", () => {
  $("#modal-aviso-fixacoes").modal("hide");
  excluirFixacao();
});

$('.minimal[name="futuro"]').on("ifChecked", event => {
  event.target.value = event.target.id == "f" ? 1 : 0;
  setNumeroConfirmacao();
});

// Verifica se a variavel contrato está setada
temContratoL = () => (contrato ? true : false);

// Verifica se a variavel adendo está setada
temAdendo = () => (adendo ? true : false);

// Verifica se a variavel fixacao está setada
temFixacao = () => (fixacao ? true : false);

/**
 * PRODUTOS
 */
function buscarProdutos() {
  $.get("../back-end/produtos").done(response => {
    produtos = JSON.parse(response);
    popularProdutos(produtos);
  });
}

popularProdutos = produtos => {
  $.each(produtos, (index, produto) => {
    const option = `<option value=${produto.id}>${produto.nome}</option>`;
    $("#produtos").append(option);
  });
};

function buscarCfops() {
  $.get(`../back-end/cfops`).done(response => {
    cfops = JSON.parse(response);
    popularCfops(cfops);
  });
}
function popularCfops(cfops) {
  $.each(cfops, (index, cfop) => {
    const option = `<option value=${cfop.id}>${cfop.descricao}</option>`;
    $("#cfops").append(option);
  });
}

function selecionarProduto(produtoId) {
  produto = _.find(produtos, { id: produtoId });
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
  $.get("../back-end/unidades-medidas").done(response =>
    popularUnidadesMedidades(JSON.parse(response))
  );
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
  $.get("../back-end/numero-confirmacao").done(response => {
    numeros_confirmacao = JSON.parse(response);
    if (temContratoL()) {
      if (parseInt(contrato.futuro, 10)) {
        numeros_confirmacao[1] = contrato.numero_confirmacao;
      } else {
        numeros_confirmacao[0] = contrato.numero_confirmacao;
      }
    }
    setNumeroConfirmacao();
  });
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

function atualizar() {
  mostrarModal();

  contratoArray = $("#contrato").serializeArray();
  $("#contrato input[type=checkbox]").map((a, b) => {
    contratoArray.push({
      name: `${b.name}`,
      value: b.checked ? 1 : 0
    });
  });

  $(contratoArray).each((index, obj) => {
    dados[obj.name] = obj.value;
  });

  formatDates([dados.data_embarque_inicial, dados.data_embarque_final], "DD/MM/YYYY", "YYYY-MM-DD", (response) => [dados.data_embarque_inicial, dados.data_embarque_final] = response);

  setTimeout(() => {
    $.ajax({
      type: "PUT",
      url: `../back-end/contratos/${contrato.id}`,
      data: dados
    })
      .done(() => {
        alertCadastro();
        exibirSucesso();
        // window.location.href = "./contratosLista.php";
      })
      .always(() => esconderModal())
      .fail(() => exibirErro());
  }, 300);
}


function cadastrar() {
  mostrarModal();

  contratoArray = $("#contrato").serializeArray();
  $("#contrato input[type=checkbox]").map((a, b) => {
    contratoArray.push({
      name: `${b.name}`,
      value: b.checked ? 1 : 0
    });
  });

  $(contratoArray).each((index, obj) => {
    dados[obj.name] = obj.value;
  });

  formatDates([dados.data_embarque_inicial, dados.data_embarque_final], "DD/MM/YYYY", "YYYY-MM-DD", (response) => [dados.data_embarque_inicial, dados.data_embarque_final] = response);

  setTimeout(() => {
    $.post("../back-end/contratos", dados)
      .done(ct => {
        contrato = JSON.parse(ct);
        alertCadastro();
        exibirSucesso();
        window.location.href = "./contratosLista.php";
      })
      .always(() => esconderModal())
      .fail(() => exibirErro());
  }, 300);
}

/**
 * Verify if exists a property
 * 
 * @param objProperty - property to be verified 
 */
exists = (objProperty) => (objProperty) ? true : false;

formatDates = (dates, formatA, formatB, callback = null) => {
  if (Array.isArray(dates)) {
    for (let index = 0; index < dates.length; index++) {
      if (dates[index]) {
        dates[index] = moment(dates[index], formatA).format(formatB);
      } else {
        dates[index] = null;
      }
    }
  }
  callback(dates);
}

/** FIM CONTRATO */

/** ADENDOS */
function buscarAdendos() {
  $.get(`../back-end/contratos/${contrato.id}/adendos`).done(adendos => {
    _adendos = JSON.parse(adendos);
    listarAdendos(JSON.parse(adendos));
  });
}

function buscarFixacoes() {
  $.get(`../back-end/contratos/${contrato.id}/fixacoes`).done(fixacoes => {
    _fixacoes = JSON.parse(fixacoes);
    listarFixacoes(JSON.parse(fixacoes));
  });
}

function cadastrarFixacao() {
  mostrarModal();
  $(`#fixacao`).append(
    `<input hidden name='contrato_id' value=${contrato.id}>`
  );
  const dados = $("#fixacao").serialize();
  $.post(`../back-end/contratos/fixacoes`, dados)
    .done(fixacoes => {
      _fixacoes = JSON.parse(fixacoes);
      exibirSucesso();
      listarFixacoes(_fixacoes);
      fixacao = null;
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
      adendo = null;
    })
    .fail(() => exibirErro())
    .always(() => esconderModal());
}

function listarAdendos(adendos) {
  $("#adendos tr").remove();
  for (const adendo of adendos) {
    var newRow = $(`<tr>`);
    var cols = "";
    cols += `<td class='item' id=${adendo.id}>${adendo.descricao}</td>`;
    cols += `<td>
            <button type="button" class="btn btn-primary download" id="${
      adendo.id
      }">
                <i class="fa fa-print" id="${adendo.id}"></i>
            </button>
        </td>`;
    cols += `<td class="item" id=${adendo.id}>
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-aviso">
                <i class="fa fa-trash-o"></i>
            </button>
        </td>`;
    newRow.append(cols);
    $("#adendos").append(newRow);
  }
  $("#adendos .item").each((index, td) => {
    $(td).attr("onclick", `selecionarAdendo(${td.id})`);
  });
  $(`#adendos .download`).on("click", ({ target }) => {
    abrirAdendos(target.id);
  });
}

function listarFixacoes(fixacoes) {
  $("#fixacoes tr").remove();
  for (const fixacao of fixacoes) {
    var newRow = $(`<tr>`);
    var cols = "";
    cols += `<td class='item' id=${fixacao.id}>${fixacao.quantidade}</td>`;
    cols += `<td class='item' id=${fixacao.id}>${fixacao.preco}</td>`;
    cols += `<td class='item' id=${fixacao.id}>${fixacao.local_embarque}</td>`;
    cols += `<td class='item' id=${fixacao.id}>${fixacao.data_pagamento}</td>`;

    cols += `<td class='item' id=${fixacao.id}>${
      fixacao.contaBancaria.conta
      } | ${fixacao.contaBancaria.agencia} - ${fixacao.contaBancaria.banco}</td>`;
    cols += `<td style="text-align:center" id="${fixacao.id}">
        <button type="button" class="btn btn-primary download" id="${
      fixacao.id
      }">
            <i class="fa fa-print" id="${fixacao.id}"></i>
        </button>
    </td>`;
    cols += `<td class="item" id=${fixacao.id}>
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-aviso-fixacoes">
            <i class="fa fa-trash-o"></i>
        </button>
    </td>`;
    newRow.append(cols);
    $("#fixacoes").append(newRow);
  }
  $("#fixacoes .item").each((index, td) => {
    $(td).attr("onclick", `selecionarFixacao(${td.id})`);
  });
  $(`#fixacoes .download`).on("click", ({ target }) => {
    abrirFixacoes(target.id);
  });
}

function abrirFixacoes(ctId) {
  window.open(`../back-end/pdfs/contratos/fixacoes/${ctId}`, "_blank");
}
function abrirAdendos(addId) {
  window.open(`../back-end/pdfs/contratos/adendos/${addId}`, "_blank");
}

function selecionarFixacao(fixacaoId) {
  fixacao = _.find(_fixacoes, { id: `${fixacaoId}` });
  compararForm(fixacao, "fixacao");
}

function selecionarAdendo(adendoId) {
  adendo = _.find(_adendos, { id: `${adendoId}` });
  compararForm(adendo, "adendo");
}

function excluirFixacao() {
  mostrarModal();
  $.ajax({
    url: `../back-end/fixacoes/${fixacao.id}`,
    type: "DELETE"
  })
    .done(() => {
      buscarFixacoes();
      fixacao = null;
    })
    .always(() => esconderModal());
}

function excluirAdendo() {
  mostrarModal();
  $.ajax({
    url: `../back-end/adendos/${adendo.id}`,
    type: "DELETE"
  })
    .done(() => {
      buscarAdendos();
      adendo = null;
    })
    .always(() => esconderModal());
}

function atualizarFixacao() {
  mostrarModal();
  $(`#fixacao`).append(
    `<input hidden name='contrato_id' value=${contrato.id}>`
  );
  $(`#fixacao`).append(`<input hidden name='id' value=${fixacao.id}>`);
  const dados = $("#fixacao").serialize();

  $.ajax({
    type: "PUT",
    url: `../back-end/fixacoes/${fixacao.id}`,
    data: dados
  })
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
  $.ajax({ type: "PUT", url: `../back-end/adendos/${adendo.id}`, data: dados })
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
  $("#modal-default").modal({ backdrop: "static", keyboard: false });
}

function esconderModal() {
  $("#modal-default").modal("hide");
}

function alertCadastro() {
  $(".alert i").append("Cadastrado");
  $(".alert span").append("Cadastrado com sucesso!");
  $(".alert").show("fast", () => {
    setTimeout(() => {
      $(".alert").hide("slow");
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
    form = $(`#${formulario}`).find("select, input, textarea");
    $(form).each(function (index, formObj) {
      if (typeof valor === "object" && valor) {
        compararForm(valor, campo);
      }
      if (formObj.name === campo && formObj.name === "data_embarque_inicial") {
        $("#data_embarque_inicial").val(
          moment(valor, "YYYY-MM-DD").format("DD/MM/YYYY")
        );
      }
      formObj.name === campo ? $(formObj).val(valor) : null;
    });
  });
}

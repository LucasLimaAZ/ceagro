$(document).ready(() => {
  contrato = JSON.parse(localStorage.getItem("contrato"));
  buscarClientes();
});

$("#comprador .clientes").change(event => {
  selecionarComprador(event.target.value, cmp => popularUnidadesComprador(cmp));
});

$("#vendedor .clientes").change(event => {
  selecionarVendedor(event.target.value, vnd => popularUnidadesVendedor(vnd));
});

let clientes = null;
let comprador = null;
let vendedor = null;

/**
 * Verifica se há um contrato no localstorage.
 */
function temContrato() {
  localStorage.removeItem("contrato");
  return contrato != null ? true : false;
}

function buscarClientes() {
  $.get("../back-end/clientes")
    .done(response => {
      clientes = JSON.parse(response);
      popularCompradores(clientes);
      popularVendedores(clientes);

      if (temContrato()) {
        compararContrato(contrato, "contrato");
        selecionarVendedor(contrato.vendedor_id, vnd => {
          popularUnidadesVendedor(vnd);
        });
        selecionarComprador(contrato.comprador_id, cmp => {
          popularUnidadesComprador(cmp);
        });
      }
    })
    .always(() => {
      $(".overlay").remove();
    });
}

/**
 * COMPRADOR
 */

/**
 * Monta o datalist de compradores.
 *
 *
 * @param {obj} compradores - lista de compradores.
 */
function popularCompradores(compradores) {
  $.each(compradores, (index, comprador) => {
    const cliente = `<option value=${comprador.id}> ${comprador.nome_fantasia ||
      comprador.razao_social}</option>`;
    $("#comprador .clientes").append(cliente);
  });
}

/**
 * Filtra um dentre os clientes para ser um comprador.
 *
 *
 * @param {int} compradorId - Id do comprador clicado.
 * @param {any} callback - um callback qualquer.
 */
function selecionarComprador(compradorId, callback) {
  comprador = _.find(clientes, {
    id: compradorId
  });
  callback(comprador);
}

function selecionarUnidadeVendedor(compradorId, callback) {
  unidadeVendedor = _.find(vendedor.unidades, {
    id: compradorId
  });
  callback(unidadeVendedor);
}

/**
 * Muda os campos de inscrição estadual, cnpj , razão social e endereço.
 *
 * @param {} comprador - Um objeto de comprador.
 */
function popularUnidadesComprador(comprador) {
  $("#comprador .unidades option").remove();
  $.each(comprador.unidades, (index, unidade) => {
    const cnpj = `<option value=${unidade.id}>
            <span>${unidade.razao_social || "-"}| ${unidade.cnpj ||
      "-"}, inscrição: ${unidade.inscricao_estadual || " - "}</span>
            <span> ${unidade.endereco.cidade}(${unidade.endereco.estado}) | ${
      unidade.endereco.rua
      } </span>
        </option>`;
    $("#comprador .unidades").append(cnpj);
    if(contrato) {
      $("#comprador .unidades#cnpj").val(contrato.unidade_comprador_id);
    }

  });
}

/**
 * FIM COMPRADOR
 */

/**
 * VENDEDOR
 */
function popularVendedores(vendedores) {
  $.each(vendedores, (index, vendedor) => {
    const cliente = `<option value=${vendedor.id}> ${vendedor.nome_fantasia ||
      vendedor.razao_social}</option>`;
    $("#vendedor .clientes").append(cliente);
  });
}

function selecionarVendedor(vendedorId, callback) {
  vendedor = _.find(clientes, {
    id: vendedorId
  });

  callback(vendedor);
  buscarContasBancarias(vendedor.id);
}

function popularUnidadesVendedor(vendedor) {
  $("#vendedor .unidades option").remove();
  $.each(vendedor.unidades, (index, unidade) => {
    const cnpj = `<option value=${unidade.id}>
            <span>${unidade.razao_social || "-"}| ${unidade.cnpj ||
      "-"}, inscrição: ${unidade.inscricao_estadual || " - "}</span>
            <span> ${unidade.endereco.cidade}(${unidade.endereco.estado}) | ${
      unidade.endereco.rua
      } </span>
        </option>`;
    $("#vendedor .unidades").append(cnpj);
    if(contrato) {
      $("#vendedor .unidades#cnpj").val(contrato.unidade_vendedor_id);
    }
  });
}

/**
 * FIM VENDEDOR
 */

function buscarContasBancarias(vendedorId) {
  $.get(`../back-end/clientes/${vendedorId}/contas-bancarias`).done(response =>
    popularContasBancarias(JSON.parse(response))
  );
}

function popularContasBancarias(contas) {
  $("#contas option").remove();
  $("#contas2 option").remove();
  $("#select2-contas-contais").remove();
  $("#select2-contas2-contais").remove();
  if (contas.length < 1) {
    const contas = `<option value=${null}>Não há conta cadastrada</option>`;
    $("#contas").append(contas);
    $("#contas").prop("disabled", true);
    $("#contas2").append(contas);
    $("#contas2").prop("disabled", true);
  } else {
    $("#contas").prop("disabled", false);
  }

  $.each(contas, (index, conta) => {
    const conts = `<option value=${conta.id}>${conta.conta} | ${
      conta.agencia
      } - ${conta.banco}</option>`;
    $("#contas").append(conts);
    $("#contas2").append(conts);
  });
  if(contrato) {
     $("#vendedor #contas").val(contrato.vendedor_conta_bancaria_id);   
  }
}

/**
 * Verifica e preenche os campos do contrato de acordo com um objeto.
 *
 * @param {*} contrato - Objeto do contrato, ou um campo qualquer.
 * @param {*} formulario - Id do formulário referente.
 */
function compararContrato(contrato, formulario) {
  $.each(contrato, function (campo, valor) {
    form = $(`#${formulario}`).find("select, input, textarea");
    $(form).each(function (index, formObj) {
      if (typeof valor === "object" && valor) {
        compararContrato(valor, campo);
      }
      if (
        formObj.name === campo &&
        formObj.name === "imediato" &&
        valor === "1"
      ) {
        $(formObj).attr("checked", "checked");
      } else if (
        formObj.name === campo &&
        formObj.name === "exportacao" &&
        valor === "1"
      ) {
        $(formObj).attr("checked", "checked");
      } else if (formObj.name === campo && formObj.name === "data_embarque_inicial") {
        setTimeout(() => {
          if (valor) {
            $("#data_embarque_inicial").val(
              moment(valor, "YYYY-MM-DD").format("DD/MM/YYYY")
            );
          }
        }, 1000);
      } else if (formObj.name === campo && formObj.name === "data_embarque_final") {
        setTimeout(() => {
          if (valor) {
            $("#data_embarque_final").val(
              moment(valor, "YYYY-MM-DD").format("DD/MM/YYYY")
            );
          }
        }, 1000);
      } else if (formObj.name === campo) {
        $(formObj).val(valor);
      }
    });
  });
}

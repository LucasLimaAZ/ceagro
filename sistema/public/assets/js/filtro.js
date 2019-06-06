$("document").ready(() => {
  $('.select2').select2()
  $("#datas").submit(function(event) {
    event.preventDefault();
    var dados = $("#datas").serialize();
    window.open(`../back-end/pdfs/datas?${dados}`, "_blank", dados);
  });

  $.get("../back-end/clientes").done(response =>  popularClientes(JSON.parse(response)));

  popularClientes = (clientes) => {
    $.each(clientes, (index, cliente) => {
        const linha = `<option value=${cliente.id}> ${cliente.nome_fantasia || cliente.razao_social}</option>`;
        $("#clientes").append(linha);
    });
  }

  //$('.select2').on('change', ({target}) => window.open(`../back-end/pdfs/contratos/clientes/${target.value}`, "_blank"));
  $('#porClienteTodos').submit(({target}) => window.open(`../back-end/pdfs/contratos/clientes/${target.value}`, "_blank"));
});

$("document").ready(() => {
  var cliente = $('#clientes').val();

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
        $("#clientes2").append(linha);
        $("#clientes3").append(linha);
    });
  }

  $('.todos').on('change', ({target}) => window.open(`../back-end/pdfs/contratos/clientes/${target.value}`, "_blank"));
  $('.futuros').on('change', ({target}) => window.open(`../back-end/pdfs/contratos/clientes/futuros/${target.value}`, "_blank"));
  $('.atuais').on('change', ({target}) => window.open(`../back-end/pdfs/contratos/clientes/atuais/${target.value}`, "_blank"));

  /*
  $('#todos').click(function(){
    alert(cliente);
    window.open(`../back-end/pdfs/contratos/clientes/${cliente}`, "_blank");
  });
  */

});
$("document").ready(() => {
  $("#datas").submit(function(event) {
    event.preventDefault();
    var dados = $("#datas").serialize();
    window.open(`../back-end/pdfs/datas?${dados}`, "_blank", dados);
  });
});

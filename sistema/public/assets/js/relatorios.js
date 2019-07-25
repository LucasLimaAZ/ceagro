var links = [
  { link: "../back-end/pdfs/contratos/futuros", name: "Contratos Futuros" },
  { link: "../back-end/pdfs/contratos/atuais", name: "Contratos Atuais" }
];

var lista = [];

$(document).ready(() => {
  $.each(links, (index, elemento) => {
    var linha = `<li>
        <a href='${elemento.link}' target='_blank' rel='noopener noreferrer'>${
      elemento.name
    }</a>
    </li>`;
    $("#lista").append(linha);
  });
});

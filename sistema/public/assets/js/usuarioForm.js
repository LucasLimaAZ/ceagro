var query = location.search.slice(1);
var partes = query.split('&');
var data = {};
var usuario = {};

if(query) {
    partes.forEach(function (parte) {
        var chaveValor = parte.split('=');
        var chave = chaveValor[0];
        var valor = chaveValor[1];
        data[chave] = valor;
    });
    
    $.get(`../back-end/usuarios/${data.u}`)
    .done(usuario => console.log(JSON.parse(a)));
}
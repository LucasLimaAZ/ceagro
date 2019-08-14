$(document).ready(function () {
    $(document).ajaxError(function (event, jqxhr, settings, thrownError) {
        var url = '';
        if (location.hostname === "localhost" || location.hostname === "127.0.0.1") {
            url = "/ceagro/sistema/";
        } else {
            url = "/sistema/";
        }
        if (jqxhr.status === 401) {
            window.location.href = url;
        }
    });

});

$('#botao-login').click(() => {

    var dados = [];
    dados['usuario'] = $('#usuario').val();
    dados['senha'] = $('#senha').val();

    if ($('#usuario').val() == 'ceagro' && $('#senha').val() == 'sucesso19#') {

        $.post("../back-end/login").done(() => {
            window.location = 'home.php';
        });

    } else {
        alert("Usuário ou senha incorretos!");
    }

});
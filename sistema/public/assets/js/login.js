$(document).ready(function () {

    $.get("../back-end/login").done(response => {
        //     console.log(response);
        //     // logado = JSON.parse(response);
        //     // alert(logaado);
    });

});

$('#botao-login').click(function () {

    var dados = [];
    dados['usuario'] = $('#usuario').val();
    dados['senha'] = $('#senha').val();

    if ($('#usuario').val() == 'ceagro' && $('#senha').val() == 'sucesso19#') {

        window.location.replace("home.php");

    } else {
        $('#message').html("Usuário ou senha incorreto!");
    }


});
$('#botao-login').click(function(){

    var dados = [];
    dados['usuario'] = $('#usuario').val();
    dados['senha'] = $('#senha').val();

    $.ajax({
        type: "POST",
        url: '../back-end/login',
        data: dados
    })
      
});
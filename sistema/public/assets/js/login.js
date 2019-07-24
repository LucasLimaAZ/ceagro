$('#botao-login').click(function(){

    var dados = [];
    dados['usuario'] = $('#usuario').val();
    dados['senha'] = $('#senha').val();

    if($('#usuario').val() == 'ceagro' && $('#senha').val() == 'sucesso19#'){

        window.location.replace("home.php");

    }else{
        $('#message').html("Usuário ou senha incorreto!");
    }
    
      
});
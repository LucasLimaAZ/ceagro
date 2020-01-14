$("#botao-atualizar").click(() => {
    atualizarContratos()
    $("#atualizar").hide()
    $("#tudo-pronto").fadeIn(700)
})

function atualizarContratos()
{
    $.get("contratos/adaptarAno", response => {
        console.log(response)
    })
}
$("#botao-atualizar").click(() => {
    atualizarContratos()
    $("#atualizar").hide()
    $("#tudo-pronto").fadeIn(700)
})

function atualizarContratos()
{
    $.get("../back-end/contratos/adaptarAno", response => {
        console.log(response)
    })
}
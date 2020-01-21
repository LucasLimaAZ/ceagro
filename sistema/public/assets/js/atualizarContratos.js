$("#botao-atualizar").click(() => {
    $("#loading").show(200)
    atualizarContratos()
})

function atualizarContratos()
{
    $.get("../back-end/contratos/adaptarAno")
    .done(() => {
        $("#atualizar").hide()
        $("#tudo-pronto").fadeIn(700)
    })
    .fail(() => {
        $("#atualizar").hide()
        $("#erro").fadeIn(700)
    })
    .always(() => {
        $("#loading").hide(200)
    })
}
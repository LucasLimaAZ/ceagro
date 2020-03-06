$.ajaxSetup({
    beforeSend: function (xhr) {
        if (localStorage.getItem('usuarioLogado')) {
            const uL = JSON.parse(JSON.parse(localStorage.getItem('usuarioLogado')));
            console.log(uL.login);
            xhr.setRequestHeader('Authorization', `Bearer ${btoa(uL.login)} ${btoa(uL.senha)}`);
        }
    },
});
$(document).ready(() => {
    $(document).ajaxError(function (event, jqxhr, settings, thrownError) {
        const url = (location.hostname === "localhost" || location.hostname === "127.0.0.1") ? "/jobs/ceagro/sistema/" : "/sistema/";
        if (jqxhr.status === 401) {
            window.location.href = url;
        }
    });

});

$('#botao-login').click(() => {
    let dados = $("#login").serializeArray();
    $.post(`../back-end/login`, dados)
        .done(response => {
            localStorage.setItem("usuarioLogado", JSON.stringify(response));
            window.location = 'home.php';
        }).fail(() => {
            $(`.erro-login`).show("slow");
            setTimeout(() => $(".erro-login").hide("slow"), 3000);
        });
});
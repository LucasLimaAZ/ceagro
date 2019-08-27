/**
 * Configurações geral do ajax
 */
$.ajaxSetup({
    /**
     * Antes de enviar insere o header de autorização
     * usando o login e a senha do usuário em codificação de 64bits.
     * 
     * @param {*} xhr - requisição a ser alterada
     */
    beforeSend: function (xhr) {
        /**
         * Verifica se existe um usuário logado no localstorage
         */
        if (localStorage.getItem('usuarioLogado')) {
            /**
             * Recebe o usuário logado em uma variável.
             */
            const uL = JSON.parse(JSON.parse(localStorage.getItem('usuarioLogado')));
            /**
             * Codifica o login e a senha, e insere como header
             */
            xhr.setRequestHeader('Authorization', `Bearer ${btoa(uL.login)} ${btoa(uL.senha)}`);
        }
    },
});

$(document).ready(() => {
    /**
     * Se a requisição retornar um erro
     * E esse erro sendo ele 401 - unauthorized
     * redirecionará para home
     */
    $(document).ajaxError(function (event, jqxhr, settings, thrownError) {
        /**
         * Verifica se é localhost ou não
         */
        const url = (location.hostname === "localhost" || location.hostname === "127.0.0.1") ? "/ceagro/sistema/" : "/sistema/";
        /**
         * Verifica se é 401
         */
        if (jqxhr.status === 401) {
            /**
             * Redireciona
             */
            window.location.href = url;
        }
    });

});

$('#botao-login').click(() => {
    const dados = $("#login").serializeArray();
    $.post(`../back-end/login`, dados)
        .done(response => {
            localStorage.setItem("usuarioLogado", JSON.stringify(response));
            window.location = 'home.php';
        }).fail(() => {
            $(`.erro-login`).show("slow");
            setTimeout(() => $(".erro-login").hide("slow"), 3000);
        });
});
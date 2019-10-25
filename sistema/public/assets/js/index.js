clientes = new Array();

$.get("../back-end/clientes", function (response) {
    clientes = JSON.parse(response);
    $('#clientes h3').text(_.size(clientes));
    $('#clientes.inner h3').each(function () {
        $(this).prop('Counter', 0).animate({
            Counter: $(this).text()
        }, {
                duration: 4000,
                easing: 'swing',
                step: function (now) {
                    $(this).text(Math.ceil(now));
                }
            });
    });
});

$.get("../back-end/contratos/futuros", function (response) {
    contratosFuturos = JSON.parse(response);
    $('#contratos_fut h3').text(contratosFuturos);
    $('#contratos_fut.inner h3').each(function () {
        $(this).prop('Counter', 0).animate({
            Counter: $(this).text()
        }, {
                duration: 4000,
                easing: 'swing',
                step: function (now) {
                    $(this).text(Math.ceil(now));
                }
            });
    });
});

$.get("../back-end/contratos/atuais", function (response) {
    contratosFuturos = JSON.parse(response);
    $('#contratos h3').text(contratosFuturos);
    $('#contratos.inner h3').each(function () {
        $(this).prop('Counter', 0).animate({
            Counter: $(this).text()
        }, {
                duration: 4000,
                easing: 'swing',
                step: function (now) {
                    $(this).text(Math.ceil(now));
                }
            });
    });
});


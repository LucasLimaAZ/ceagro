$('document').ready(() => {
    $.get("../back-end/clientes")
        .done(response => {
            montarClientes(JSON.parse(response));
        });
});
let clientesSemUnidades = [];
let clienteCSV = [];
let csvContent = "data:text/csv;charset=utf-8,";

montarClientes = clientes => {
    $.each(clientes, (index, cliente) => {
        if (!(cliente.unidades.length > 0)) {
            clientesSemUnidades.push(`${cliente.razao_social} (${cliente.cnpj})`);
            clienteCSV = `${cliente.razao_social};${cliente.cnpj};`;
            csvContent += clienteCSV + "\r\n";
        }
    });
    setTimeout(() => {
        var encodedUri = encodeURI(csvContent);
        var link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", "clientes_sem_unidades.csv");
        document.body.appendChild(link); // Required for FF

        link.click(); // This will download the data file named "my_data.csv".

    }, 2000);
}

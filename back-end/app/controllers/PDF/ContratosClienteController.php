<?php

namespace App\Controllers\PDF;

use App\Models\Contrato;
use App\Models\Cliente;
use Dompdf\Dompdf;

class ContratosClienteController
{

    public function index($clienteId)
    {
        $contratosVendedor = Contrato::where(["vendedor_id",$clienteId]);
        $contratosComprador = Contrato::where(["comprador_id",$clienteId]);
        $produtosVendidos = Cliente::produtosVendidos($clienteId);
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');

        header('Content-type: text/html; charset=UTF-8');
        ob_start();

        include_once "app/views/contratosCliente.php";

        $html = ob_get_contents();

        ob_end_clean();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("codexworld", array("Attachment" => 0));
    }
}
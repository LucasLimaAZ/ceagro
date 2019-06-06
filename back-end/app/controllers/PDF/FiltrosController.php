<?php

namespace App\Controllers\PDF;

use App\Models\Contrato;
use App\Models\Cliente;
use Dompdf\Dompdf;
class FiltrosController
{

    public function index()
    {
        $contrato = Contrato::get(["data_embarque_inicial" , ">= CAST('".$_GET['data-inicial']."' AS DATE)", "AND data_embarque_final <= CAST('".$_GET['data-final']."' AS DATE)"]);
        
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');

        header('Content-type: text/html; charset=UTF-8');
        ob_start();

        include_once "app/views/contratos.php";

        $html = ob_get_contents();

        ob_end_clean();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("codexworld", array("Attachment" => 0));
    }

    public function porCliente($clienteId)
    {
        $comprador = Contrato::get(['comprador_id',$clienteId]);
        $vendedor = Contrato::get(['vendedor_id',$clienteId]);

        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');

        header('Content-type: text/html; charset=UTF-8');
        ob_start();

        include_once "app/views/porCliente.php";

        $html = ob_get_contents();

        ob_end_clean();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("codexworld", array("Attachment" => 0));
    }

    public function porClienteFuturo($clienteId)
    { 
        $contratosVendedor = Contrato::where(["vendedor_id",$clienteId]);
        $contratosComprador = Contrato::where(["comprador_id",$clienteId]);
        $produtosVendidos = Cliente::produtosVendidos($clienteId);

        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');

        header('Content-type: text/html; charset=UTF-8');
        ob_start();

        include_once "app/views/futurosCliente.php";

        $html = ob_get_contents();

        ob_end_clean();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("codexworld", array("Attachment" => 0));
    }

    public function porClienteAtual($clienteId)
    {
        $contratosVendedor = Contrato::where(["vendedor_id",$clienteId]);
        $contratosComprador = Contrato::where(["comprador_id",$clienteId]);
        $produtosVendidos = Cliente::produtosVendidos($clienteId);
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');

        header('Content-type: text/html; charset=UTF-8');
        ob_start();

        include_once "app/views/atuaisCliente.php";

        $html = ob_get_contents();

        ob_end_clean();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("codexworld", array("Attachment" => 0));
    }

}
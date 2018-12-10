<?php

namespace App\Controllers\PDF;

use App\Models\Contrato;
use Dompdf\Dompdf;

class ContratosController
{

    public function index($contratoId)
    {
        $contrato = Contrato::find(["id", $contratoId]);
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');
        $data = strftime('%A, %d de %B de %Y', strtotime('today'));
        ob_start();

        include_once "app/views/index.php";

        $html = ob_get_contents();

        ob_end_clean();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("codexworld", array("Attachment" => 0));
    }
}
<?php

namespace App\Controllers\PDF;

use App\Models\Adendo;
use Dompdf\Dompdf;

class AdendosController
{

    public function index($contratoId)
    {
        $adendos = Adendo::get(['contrato_id', '=',$contratoId]);
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');
        $data = strftime('%A, %d de %B de %Y', strtotime('today'));
        header('Content-type: text/html; charset=UTF-8');
        ob_start();
        include_once "app/views/adendos.php";
        
        $html = ob_get_contents();
        
        ob_end_clean();
        
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        // dd($adendos);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("codexworld", array("Attachment" => 0));
    }
}

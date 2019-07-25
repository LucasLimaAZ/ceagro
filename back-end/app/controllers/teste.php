<?php

namespace App\Controllers;

use Dompdf\Dompdf;

class Teste
{

    public function index()
    {
        $html = file_get_contents("app/views/index.php");
        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF (1 = download and 0 = preview)
        $dompdf->stream("codexworld",array("Attachment"=>0));
    }
}

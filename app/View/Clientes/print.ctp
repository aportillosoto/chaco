<?php
App::import('Vendor','tcpdf/tcpdf');
// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0,0, 'Pag. '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, 
                false, 'R', 0, '', 0, false, 'T', 'M');
    }
}
// create new PDF document // CODIFICACION POR DEFECTO ES UTF-8
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Chaco Services');
$pdf->SetTitle('REPORTE DE Clientes');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
$pdf->setPrintHeader(false);
// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins POR DEFECTO
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//$pdf->SetMargins(8,10, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks SALTO AUTOMATICO Y MARGEN INFERIOR
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);


// ---------------------------------------------------------

// TIPO DE LETRA
$pdf->SetFont('times', 'B', 18);

// AGREGAR PAGINA
$pdf->AddPage('L','LEGAL');
$pdf->Cell(0,0,"REPORTE DE CLIENTES",0,1,'C');
//SALTO DE LINEA
$pdf->Ln();
//COLOR DE TABLA
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(0.2);
        
        $pdf->SetFont('', 'B',12);
        // Header
        
        $pdf->SetFillColor(180,180,180);
        $pdf->Cell(30,5,'CI/RUC', 1, 0, 'C', 1);
        $pdf->Cell(100,5,'NOMBRES/RAZON SOCIAL', 1, 0, 'C', 1);
        $pdf->Cell(50,5,'TELEFONO', 1, 0, 'C', 1);
        $pdf->Cell(50,5,'CORREO', 1, 0, 'C', 1);
        $pdf->Cell(60,5,'DIRECCION', 1, 0, 'C', 1);
        $pdf->Cell(20,5,'TIPO', 1, 0, 'C', 1);
        
    $pdf->Ln();
    $pdf->SetFont('', '');
        $pdf->SetFillColor(255, 255, 255);

        foreach ($consultas as $c) {
            $pdf->Cell(30,5,$c[0]['cli_ci_ruc'], 1, 0, 'L', 1);
            $pdf->Cell(100,5, strtoupper($c[0]['nombres']), 1, 0, 'L', 1);
            $pdf->Cell(50,5, $c[0]['cli_tel'], 1, 0, 'L', 1);
            $pdf->Cell(50,5, $c[0]['cli_email'], 1, 0, 'L', 1);
            $pdf->Cell(60,5, $c[0]['cli_direcc'], 1, 0, 'L', 1);
            $pdf->Cell(20,5, $c[0]['tipo_cliente'], 1, 0, 'L', 1);
            $pdf->Ln();
        }
        


//SALIDA AL NAVEGADOR
$pdf->Output('rpt_clientes.pdf', 'I');
?>

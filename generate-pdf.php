<?php
    ob_start();

    define('FPDF_FONTPATH','./assets/fonts/');
    require('./fpdf.php');
    $pdf = new FPDF();
    $pdf->Open();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(40,10,'First Cell - no border',0,1);
    $pdf->Cell(100,10,'Second Cell - border/centred',
    1,1,'C');
    $pdf->Ln();
    $pdf->Cell(100,10,'Third Cell - top/bottom border',
    'T,B',1);
    $pdf->Ln();
    $pdf->SetFillColor(255,0,0);
    $pdf->Cell(100,10,'Fourth Cell - border/filled',
    1,1,'C',1);
    $pdf->Output("PDFFile1.pdf");


    //header('Content-type: application/pdf');
    //header('Content-Disposition: inline; filename="PDFFile1.pdf"');
    //readfile('./PDFFile1.pdf');
?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?php
define('FPDF_FONTPATH','fonts/');
  include('Barcode.php');
  require('fpdf.php');

require('barcode.php');


  // -------------------------------------------------- //
  //                      USEFUL
  // -------------------------------------------------- //
  
  class eFPDF extends FPDF{
    function TextWithRotation($x, $y, $txt, $txt_angle, $font_angle=0)
    {
        $font_angle+=90+$txt_angle;
        $txt_angle*=M_PI/180;
        $font_angle*=M_PI/180;
    
        $txt_dx=cos($txt_angle);
        $txt_dy=sin($txt_angle);
        $font_dx=cos($font_angle);
        $font_dy=sin($font_angle);
    
        $s=sprintf('BT %.2F %.2F %.2F %.2F %.2F %.2F Tm (%s) Tj ET',$txt_dx,$txt_dy,$font_dx,$font_dy,$x*$this->k,($this->h-$y)*$this->k,$this->_escape($txt));
        if ($this->ColorFlag)
            $s='q '.$this->TextColor.' '.$s.' Q';
        $this->_out($s);
    }
  }

  // -------------------------------------------------- //
  //                  PROPERTIES
  // -------------------------------------------------- //
  
  $fontSize = 16;
  $marge    = 10;   // between barcode and hri in pixel
  $x        = 420;  // barcode center
  $y        = 788;  // barcode center
  $height   = 20;   // barcode height in 1D ; module size in 2D
  $width    = 0.57;    // barcode height in 1D ; not use in 2D
  $angle    = 0;   // rotation in degrees : nb : non horizontable barcode might not be usable because of pixelisation
  $cr		= chr(65);
	
  $code     = '|301176902700'.chr(13).'000032406122248'.chr(13).'10000'; // barcode, of course ;)
  $type     = 'code128';
  $black    = '000000'; // color in hexa
  
  
  // -------------------------------------------------- //
  //            ALLOCATE FPDF RESSOURCE
  // -------------------------------------------------- //
    
  $pdf = new eFPDF('P', 'pt');
  $pdf->AddPage();
  
  // -------------------------------------------------- //
  //                      BARCODE
  // -------------------------------------------------- //
  
  $data = Barcode::fpdf($pdf, $black, $x, $y, $angle, $type, array('code'=>$code), $width, $height);
  
  // -------------------------------------------------- //
  //                      HRI
  // -------------------------------------------------- //

  $pdf->Image("http://online.goodjobstore.com/public/images/head.jpg",0,0,595,270);
  $pdf->Image("http://online.goodjobstore.com/public/images/middle2.jpg",0,270,597,170);
  $pdf->Image("http://online.goodjobstore.com/public/images/middle3.jpg",0,440,595,250);
  $pdf->Image("http://online.goodjobstore.com/public/images/middle4.jpg",0,730,596,35);
  $pdf->Image("http://online.goodjobstore.com/public/images/middle5.jpg",1,767,250,40);
 // $pdf->Image("http://online.goodjobstore.com/public/barcode/barcode.jpg",270,780,300,30); 
  $line1 = '|301176902700'; //puwadon
  $line2= '000032406122248';//puwadon
  $line3 = '10000';  //puwadon
  $barcodeImageName = ImageBarcode($line1,$line2,$line3); //puwadon
  $pdf->Image($barcodeImageName,270,780,300,30); //Puwadon
  
 $pdf->AddFont('angsana','','angsa.php');
  $pdf->SetFont('angsana','',$fontSize);
  $pdf->SetTextColor(255, 255, 255);
  $pdf->Text(320,430,$finalPrice);
  $pdf->SetTextColor(0, 0, 0);
  $pdf->SetFont('angsana','','12');

  
  $pdf->Text(435,130,'รักษิต'.$lName);
  $pdf->SetXY(420,138);
  $pdf->MultiCell( 100  , 10 , $sAddress.' '.$sCityID.' '.$sPostCode);

  $pdf->Output('pdf1.pdf','F');
?>
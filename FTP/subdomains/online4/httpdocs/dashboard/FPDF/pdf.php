<?php
  include('Barcode.php');
  require('fpdf.php');
  
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
  
  $fontSize = 8;
  $marge    = 10;   // between barcode and hri in pixel
  $x        = 420;  // barcode center
  $y        = 788;  // barcode center
  $height   = 20;   // barcode height in 1D ; module size in 2D
  $width    = 0.57;    // barcode height in 1D ; not use in 2D
  $angle    = 0;   // rotation in degrees : nb : non horizontable barcode might not be usable because of pixelisation
  $cr		= chr(65);
	
  $code     = '|30117690271100'& chr(13) &'P000032406122248'& chr(13) &'10000'; // barcode, of course ;)
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

  $pdf->SetFont('Arial','',$fontSize);
   $pdf->SetTextColor(255, 255, 255);
  $pdf->Text(320,430,"total");
  $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Arial','','8');
  $pdf->Text(20,150,"CODE");
  $pdf->Text(30,165,"SHIPPING");
  $pdf->Text(30,180,"GIFT WARP");

  $pdf->Text(130,150,"CODE");
  $pdf->Text(130,165,"SHIPPING");
  $pdf->Text(130,180,"GIFT WARP");

  $pdf->Text(320,150,"total  .-");

  $pdf->Text(435,130,"name");
    $pdf->SetXY(420,138);
  $pdf->MultiCell( 150  , 10 , iconv( 'UTF-8','cp874' , 'CustomerCustomerCustomerCustomerCustomerCustomerCustomerCustomerCustomerCustomerCustomerCustomerCustomer' ) );

  $pdf->Text(400,195,"name");
  $pdf->Text(400,240,"order");

  $pdf->Text(440,646,"40319");
  $pdf->Text(430,660,"name");
  $pdf->Text(460,677,"order");
  $pdf->Text(130,750,"total");
  $len = $pdf->GetStringWidth($data['hri']);
  Barcode::rotate(-$len / 2, ($data['height'] / 2) + $fontSize + $marge, $angle, $xt, $yt);
  //$pdf->TextWithRotation($x + $xt, $y + $yt, $data['hri'], $angle);



  $pdf->Output();
?>
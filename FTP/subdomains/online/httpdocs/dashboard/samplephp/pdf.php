<?php
define('FPDF_FONTPATH','fonts/');
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
  
  $fontSize = 16;
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
  
  $pdf->AddFont('angsana','','angsa.php');
  $pdf->SetFont('angsana','',$fontSize);
  $pdf->SetTextColor(255, 255, 255);
  $pdf->Text(320,430,$order->Final_Price);
  $pdf->SetTextColor(0, 0, 0);
  $pdf->SetFont('angsana','','12');

  $i = 0; 
  $order_item_total_price = 0;
  
  $x1=20;
  $x2=30;
  $x3=30;
  $x4=130;
  $x5=320;
  $y1=150;
  $y2=165;
  $y3=180;

  foreach($order_items as $result):
    if(++$i > 3)
  {
	    $pdf->Text(30,$y1,'.');
		$pdf->Text($x2,$y2,'.');
		$pdf->Text($x3,$y3,'.');
		$pdf->Text($x4,$y1,'.');
	    $pdf->Text($x4,$y2,'.');
		$pdf->Text($x4,$y3,'.');
		$pdf->Text($x5,$y1,'.');
		$pdf->Text($x5,$y2,'.');
		$pdf->Text($x5,$y3,'.');

	  break;
  }
  
  $pdf->Text($x1,$y1,$result->products_Product_Code);
  $pdf->Text($x2,$y2,"SHIPPING");
  $pdf->Text($x3,$y3,"GIFT WARP");

  $pdf->Text($x4,$y1,$result->products_Pro_Name_En);
  $shipping_method = get_shipping_method($order->How_ID);
  $pdf->Text($x4,$y2,$shipping_method->Name_En);

	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);
	
$sqlGift = "SELECT Have_ID FROM have_option WHERE Order_ID = '$order->Order_ID' AND Option_ID=1";
$resultGift = mysql_query($sqlGift, $objCon) or die(mysql_error());
$gift = mysql_fetch_row($resultGift);
if($gift!=NULL)
$giftwarp='YES';
else
$giftwarp='NO';


  $pdf->Text($x4,$y3,$giftwarp);
  
  //$pdf->Text(320,150,($result->order_item_Total_Price.' .-');
  $pdf->Text($x5,$y1,($result->order_item_Total_Price).' .-');
  $pdf->Text($x5,$y2,($order->shipping_price).' .-');
  $pdf->Text($x5,$y3,($order->service_price).' .-');

  $y1=$y1+45;
  $y2=$y2+45;
  $y3=$y3+45;

  endforeach;
  $pdf->Text(435,130,$customer->FirstName.' '.$customer->LastName);
  $pdf->SetXY(420,138);
  $pdf->MultiCell( 100  , 10 , $shipping->s_Address.' '.show_city_from_id($shipping->s_City_ID).' '.$shipping->s_Postal_Code);
  

  $pdf->Text(400,195,$customer->FirstName.' '.$customer->LastName);
  $pdf->Text(400,240,$order->Order_ID);

  $pdf->Text(440,646,"40319");
  $pdf->Text(430,660,$customer->FirstName.' '.$customer->LastName);
  $pdf->Text(460,677,$order->Order_ID);
  $pdf->Text(130,750,$order->Final_Price);

  $len = $pdf->GetStringWidth($data['hri']);
  Barcode::rotate(-$len / 2, ($data['height'] / 2) + $fontSize + $marge, $angle, $xt, $yt);
  //$pdf->TextWithRotation($x + $xt, $y + $yt, $data['hri'], $angle);



  $pdf->Output('public/pdf/'.$order->Order_ID.'.pdf','F');
?>
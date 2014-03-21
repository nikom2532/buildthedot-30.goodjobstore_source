<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?

  $orderID = $_GET['orderID'];
  $finalPrice = $_GET['finalPrice'];
  $itemCode_0 = $_GET['itemCode_0'];
  $itemCode_1 = $_GET['itemCode_1'];
  $itemCode_2 = $_GET['itemCode_2'];
  $itemCode_3 = $_GET['itemCode_3'];
  $itemID_0 = $_GET['itemID_0'];
  $itemID_1 = $_GET['itemID_1'];
  $itemID_2 = $_GET['itemID_2'];
  $itemID_3 = $_GET['itemID_3'];
  $itemName_0 = $_GET['itemName_0'];
  $itemName_1 = $_GET['itemName_1'];
  $itemName_2 = $_GET['itemName_2'];
  $itemName_3 = $_GET['itemName_3'];
  $itemPrice_0 = $_GET['itemPrice_0'];
  $itemPrice_1 = $_GET['itemPrice_1'];
  $itemPrice_2 = $_GET['itemPrice_2'];
  $itemPrice_3 = $_GET['itemPrice_3'];
  $shipNameEn = $_GET['shipNameEn'];
  $shipPrice = $_GET['shipPrice'];
  $servicePrice = $_GET['servicePrice'];
  $fName = $_GET['fName'];
  $lName = $_GET['lName'];
  $sAddress = $_GET['sAddress'];
  $sCityID = $_GET['sCityID'];
  $sPostCode = $_GET['sPostCode'];
  $cusID = $_GET['cusID'];

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
  $line1 = '|010553910162500'; //puwadon
  $line2= $orderID;//puwadon
  $line3 = $finalPrice.'00';  //puwadon
  $barcodeImageName = ImageBarcode($line1,$line2,$line3); //puwadon
  $pdf->Image($barcodeImageName,270,780,300,30); //Puwadon
  
 
$pdf->AddFont('angsana','','angsa.php');
  $pdf->SetFont('angsana','',$fontSize);
  $pdf->SetTextColor(255, 255, 255);
  $pdf->Text(320,430,$finalPrice);
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


//product//
//  foreach($orderItem as $result):

 
  $pdf->Text(20,150,$itemCode_0);
  $pdf->Text(30,165,"SHIPPING");
  $pdf->Text(30,180,"GIFT WARP");

  $pdf->Text(130,150,iconv( 'UTF-8','cp874',$itemName_0));
  $pdf->Text(130,165, iconv( 'UTF-8','cp874',$shipNameEn));

	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);
	
$sqlGift = "SELECT gift_type FROM order_gifts WHERE Order_ID = '$orderID' AND Product_ID = '$itemID_0'";
$resultGift = mysql_query($sqlGift, $objCon) or die(mysql_error());
$gift = mysql_fetch_row($resultGift);
if($gift!=NULL)
$giftwarp='YES';
else
$giftwarp='NO';


  $pdf->Text(130,180,$giftwarp);
  
  //$pdf->Text(320,150,($result->order_item_Total_Price.' .-');
  $pdf->Text(320,150,($itemPrice_0).' .-');
  $pdf->Text(320,165,($shipPrice).' .-');
  $pdf->Text(320,180,($servicePrice).' .-');

if($itemCode_1!="")
{
    $pdf->Text(20,195,$itemCode_1);
  $pdf->Text(30,210,"SHIPPING");
  $pdf->Text(30,225,"GIFT WARP");

  $pdf->Text(130,195,iconv( 'UTF-8','cp874',$itemName_1));
  $pdf->Text(130,210,iconv( 'UTF-8','cp874',$shipNameEn));

$sqlGift = "SELECT gift_type FROM order_gifts WHERE Order_ID = '$orderID' AND Product_ID = '$itemID_1'";
$resultGift = mysql_query($sqlGift, $objCon) or die(mysql_error());
$gift = mysql_fetch_row($resultGift);
if($gift!=NULL)
$giftwarp='YES';
else
$giftwarp='NO';

  $pdf->Text(130,225,$giftwarp);
  
  //$pdf->Text(320,150,($result->order_item_Total_Price.' .-');
  $pdf->Text(320,195,($itemPrice_1).' .-');
  $pdf->Text(320,210,($shipPrice).' .-');
  $pdf->Text(320,225,($servicePrice).' .-');
}

if($itemCode_2!="")
{
   $pdf->Text(20,240,$itemCode_2);
  $pdf->Text(30,255,"SHIPPING");
  $pdf->Text(30,270,"GIFT WARP");

  $pdf->Text(130,240,iconv( 'UTF-8','cp874',$itemName_2));
  $pdf->Text(130,255,iconv( 'UTF-8','cp874',$shipNameEn));

$sqlGift = "SELECT gift_type FROM order_gifts WHERE Order_ID = '$orderID' AND Product_ID = '$itemID_2'";
$resultGift = mysql_query($sqlGift, $objCon) or die(mysql_error());
$gift = mysql_fetch_row($resultGift);
if($gift!=NULL)
$giftwarp='YES';
else
$giftwarp='NO';

  $pdf->Text(130,270,$giftwarp);
  
  //$pdf->Text(320,150,($result->order_item_Total_Price.' .-');
  $pdf->Text(320,240,($itemPrice_2).' .-');
  $pdf->Text(320,255,($shipPrice).' .-');
  $pdf->Text(320,270,($servicePrice).' .-');
}
  if($itemCode_3!="")
  {
	    $pdf->Text(30,285,'.');
		$pdf->Text(30,300,'.');
		$pdf->Text(30,315,'.');
		$pdf->Text(130,285,'.');
	    $pdf->Text(130,300,'.');
		$pdf->Text(130,315,'.');
		$pdf->Text(320,285,'.');
		$pdf->Text(320,300,'.');
		$pdf->Text(320,315,'.');

//	  break;
  }

  /*$y1=$y1+45;
  $y2=$y2+45;
  $y3=$y3+45;
*/
//  endforeach;

//product//
  
  
  $pdf->Text(435,130, iconv( 'UTF-8','cp874' ,$fName.' '.$lName));
  $pdf->SetXY(420,138);
  $pdf->MultiCell( 100  , 10 ,  iconv( 'UTF-8','cp874' ,$sAddress.' '.$sCityID.' '.$sPostCode));
  

  $pdf->Text(400,195,$cusID);
  $pdf->Text(400,240,$orderID);

  $pdf->Text(440,646,"40319");
  $pdf->Text(430,660, iconv( 'UTF-8','cp874' ,$fName.' '.$lName));
  $pdf->Text(460,677,$orderID);
  $pdf->Text(130,750,$finalPrice);
	
 /* $pdf->Text(275,820,'|');
  $pdf->Text(320,820,'0105539101625');
  $pdf->Text(380,820,'00');
  $pdf->Text(430,820,$orderID);
  $pdf->Text(550,820,$finalPrice);*/
  $len = $pdf->GetStringWidth($data['hri']);
  Barcode::rotate(-$len / 2, ($data['height'] / 2) + $fontSize + $marge, $angle, $xt, $yt);
  //$pdf->TextWithRotation($x + $xt, $y + $yt, $data['hri'], $angle);
  $pdf->Output('../../public/pdf/'.$orderID.'.pdf','F');
?>
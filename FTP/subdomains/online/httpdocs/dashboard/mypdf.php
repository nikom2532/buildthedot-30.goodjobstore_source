<?php
define('FPDF_FONTPATH','font/');
 
require('FPDF.php');
  

$pdf = new ThaiPDF();
$pdf->Addpage();

$pdf->AddThaifont();
$pdf->SetFont("iris","", 14);
$pdf->Image("http://online.goodjobstore.com/public/images/logo.jpg",10,10,85,10);
$pdf->Image("http://online.goodjobstore.com/public/images/addrbill.png",10,20,120,15);
$pdf->Image("http://online.goodjobstore.com/public/images/paymentbill.png",160,25,40,10);

$pdf->Rect(10, 40, 130, 9, "DF");
$pdf->Rect(145, 40, 60, 50, "D");

$pdf->SetTextColor(255,255,255);
$pdf->SetFont("iris","B",15);
$pdf->Text(50,45,"รายการสินค้า");
$pdf->Text(120,45,"ราคา (บาท)");

/*Product Data ถ้าวนลูปเอา 54 ไปบวกทีละ 5 */
$pdf->SetTextColor(0,0,0);
$pdf->SetFont("iris","B",15);
$pdf->Text(15,54,"product");
$pdf->Text(50,54,"detail");
$pdf->Text(120,54,"price");
/*Product Data*/

$pdf->SetTextColor(0,0,0);
$pdf->SetFont("iris","",14);
$pdf->Text(150,45,"ชื่อลูกค้า : ");
$pdf->Text(150,50,"ที่อยู่ : ");

$pdf->SetXY(163,41);
$pdf->MultiCell( 30  , 5 , iconv( 'UTF-8','cp874' , 'Customer' ) );
$pdf->SetXY(157,46);
$pdf->MultiCell( 45  , 5 , iconv( 'UTF-8','cp874' , 'AddressAddressAddressAddressAddressAddressAddressAddressAddressAddressAddress' ) );


$pdf->Text(150,65,"หมายเลขลูกค้า : ");
$pdf->Rect(150,66, 47, 5, "D");
$pdf->Text(150,80,"หมายเลขคำสั่งซื้อ : ");
$pdf->Rect(150,81, 47, 5, "D");

$pdf->SetXY(150,66);
$pdf->MultiCell( 30  , 5 , iconv( 'UTF-8','cp874' , 'CustomerID' ) );
$pdf->SetXY(150,81);
$pdf->MultiCell( 30  , 5 , iconv( 'UTF-8','cp874' , 'Order No.' ) );


$pdf->Rect(10,139, 130, 9, "DF");
$pdf->SetTextColor(255,255,255);
$pdf->SetFont("iris","B",15);
$pdf->Text(15,145,"รวมเงินที่ต้องชำระทั้งสิ้น");
$pdf->Text(130,145,"บาท");

$pdf->SetFont("iris","B",15);
$pdf->SetTextColor(255,255,255);
$pdf->Text(120,145,'Total');

$pdf->Image("http://online.goodjobstore.com/public/images/waypay.png",143,97,65,53);

$pdf->Image("http://online.goodjobstore.com/public/images/headpay.png",10,150,190,30);
$pdf->Image("http://online.goodjobstore.com/public/images/middlepay.png",8,188,190,80);
$pdf->Image("http://online.goodjobstore.com/public/images/footerpay.png",9,268,65,10);

$pdf->SetTextColor(0,0,0);
$pdf->SetXY(140,225.5);
$pdf->MultiCell( 30  , 5 , iconv( 'UTF-8','cp874' , 'CustomerID' ) );
$pdf->SetXY(156,231.5);
$pdf->MultiCell( 30  , 5 , iconv( 'UTF-8','cp874' , 'Order No.' ) );

$pdf->SetXY(47,258);
$pdf->MultiCell( 30  , 5 , iconv( 'UTF-8','cp874' , 'Total' ) );


$pdf->Output();
?>
 


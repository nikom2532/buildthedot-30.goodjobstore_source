<?php
include("FPDF/fpdf.php");
$pdf = new FPDF();  //สามารถกำหนดอาร์กิวเมนต์เพิ่มเติมได้ ตามที่จะกล่าวถึงต่อไป


$pdf->AddPage();		//สามารถกำหนดอาร์กิวเมนต์เพิ่มเติมได้ ตามที่จะกล่าวถึงต่อไป
$pdf->SetFont("Arial", "", 20);   //ใช้ตัวธรรมดา("")ขนาด 20 pt
$pdf->Write(10, "Hello, This is my first PDF with PHP"); //10 คือความสูงบรรทัด
$pdf->Output();		
?>
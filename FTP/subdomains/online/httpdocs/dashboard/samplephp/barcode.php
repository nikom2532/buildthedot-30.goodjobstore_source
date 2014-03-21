<?php
// Including all required classes
require('class/BCGFont.php');
require('class/BCGColor.php');
require('class/BCGDrawing.php'); 

// Including the barcode technology
include('class/BCGcode128.barcode.php'); 

// Loading Font
$font =& new BCGFont('./class/font/Arial.ttf', 8);

// The arguments are R, G, B for color.
$color_black =& new BCGColor(0, 0, 0);
$color_white =& new BCGColor(255, 255, 255); 

$code = new BCGcode128();
$code->setScale(1); // Resolution
$code->setThickness(30); // Thickness
$code->setForegroundColor($color_black); // Color of bars
$code->setBackgroundColor($color_white); // Color of spaces
$code->setFont($font); // Font (or 0)
$code->setStart("A");  //Start With Barcode 128A
$code->setTilde(true);
$str = chr(13);  /// New Line CR  **************************************
$bacodeText = "|30117690271100".$str."P000032406122248".$str."10000";  //  Input Value here  ***********
//echo $bacodeText;
$code->parse($bacodeText); // Text


/* Here is the list of the arguments
1 - Filename (empty : display on screen)
2 - Background color */
$drawing = new BCGDrawing('Image/barcode.png', $color_white);
$drawing->setBarcode($code);
$drawing->draw();

// Header that says it is an image (remove it if you save the barcode to a file)
//header('Content-Type: image/png');

// Draw (or save) the image into PNG format.
$drawing->finish($drawing->IMG_FORMAT_PNG);


?>
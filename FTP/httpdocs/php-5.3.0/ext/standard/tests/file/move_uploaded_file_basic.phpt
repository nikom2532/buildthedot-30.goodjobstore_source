--TEST--
move_uploaded_file() function
--CREDITS--
Dave Kelsey <d_kelsey@uk.ibm.com>
--SKIPIF--
<?php if (php_sapi_name()=='cli') die('skip'); ?>
--POST_RAW--
Content-type: multipart/form-data, boundary=AaB03x

--AaB03x
content-disposition: form-data; name="field1"

Joe Blow
--AaB03x
content-disposition: form-data; name="file1"; filename="file1.txt"
Content-Type: text/plain

abcdef123456789xxxDDDxxxDDDxxxDDD
--AaB03x
content-disposition: form-data; name="file2"; filename="file2.txt"
Content-Type: text/plain

abcdef123456789
--AaB03x--
--FILE--
<?php

echo "Valid move\n";
$destination1 = __FILE__ . ".tmp";

var_dump(move_uploaded_file($_FILES['file1']['tmp_name'], $destination1));
$file_contents = file_get_contents($destination1);
$contents_matches = ($file_contents == b"abcdef123456789xxxDDDxxxDDDxxxDDD");
var_dump($contents_matches);
unlink($destination1);
echo "\n";

echo "Original name of uploaded file\n";
$destination2 = __FILE__ . ".tmp2";
var_dump(move_uploaded_file($_FILES['file1']['name'], $destination2));

echo "Non-uploaded source file\n";
$source = __FILE__;
$destination3 = __FILE__ . ".tmp3";
var_dump(move_uploaded_file($source, $destination3));

echo "Valid move to existing file\n";
$destination4 = __FILE__ . ".tmp4";
$fd = fopen($destination4, "w");
fclose($fd);
var_dump(move_uploaded_file($_FILES['file2']['tmp_name'], $destination4));
unlink($destination4);

echo "Wrong parameters\n";
var_dump(move_uploaded_file());
var_dump(move_uploaded_file(1, 2, 3));


?>
--EXPECTF--
Valid move
bool(true)
bool(true)

Original name of uploaded file
bool(false)
Non-uploaded source file
bool(false)
Valid move to existing file
bool(true)
Wrong parameters

Warning: move_uploaded_file() expects exactly 2 parameters, 0 given in %s on line %d
NULL

Warning: move_uploaded_file() expects exactly 2 parameters, 3 given in %s on line %d
NULL


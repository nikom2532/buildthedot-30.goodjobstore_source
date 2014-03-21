<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!--
<?php
if ($_FILES["file"]["error"] > 0)
{
	echo "Error: " . $_FILES["file"]["error"] . "<br />";
}
else
{
	echo "Upload: " . $_FILES["file"]["name"] . "<br />";
	echo "Type: " . $_FILES["file"]["type"] . "<br />";
	echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
	echo "Stored in: " . $_FILES["file"]["tmp_name"];
}?>

<br><hr><br>

<?php
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/pjpeg"))
&& ($_FILES["file"]["size"] < 5000000))
 {
 if ($_FILES["file"]["error"] > 0)
 {
 echo "Error: " . $_FILES["file"]["error"] . "<br />";
 }
 else
 {
 echo "Upload: " . $_FILES["file"]["name"] . "<br />";
 echo "Type: " . $_FILES["file"]["type"] . "<br />";
 echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
 echo "Stored in: " . $_FILES["file"]["tmp_name"];
 }
 }
else
 {
 echo "Invalid file";
 }
?>


<br><hr><br>


<?php
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/pjpeg"))
&& ($_FILES["file"]["size"] < 5000000))
{
	if ($_FILES["file"]["error"] > 0)
	{
		echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
	}
	else
	{
		echo "Upload: " . $_FILES["file"]["name"] . "<br />";
		echo "Type: " . $_FILES["file"]["type"] . "<br />";
		echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
		echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

		if (file_exists("images/" . $_FILES["file"]["name"]))
		{
			echo $_FILES["file"]["name"] . " already exists. ";
		}
		else
		{
			move_uploaded_file($_FILES["file"]["tmp_name"],
			"images/" . $_FILES["file"]["name"]);
			echo "Stored in: " . "images/" . $_FILES["file"]["name"];
		}
	}
}
else
{
	echo "Invalid file";
}
?>
-->
<!--
<?
	
	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	if($_FILES(['img']['error']==0)
	{
		$file = $_FILES['img']['tmp_name'];
		$f = fopen($file, "r");
		$img_data = fread($f, filesize($file));
		$img_data = addslashes($img_data);
		fclose($f);
	}

	$strSQL = "INSERT INTO promotions (path) 
			VALUES ('".$img_data."')";
	mysql_query($strSQL, $objCon) or die(mysql_error());
	mysql_close($objCon);
?>
-->

<?echo "aaaa";?>
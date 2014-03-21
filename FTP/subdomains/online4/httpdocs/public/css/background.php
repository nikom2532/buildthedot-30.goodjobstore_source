<?php
	header('Content-type: text/css');

	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	
	$sql = "SELECT * FROM background WHERE status=1 LIMIT 1";
	$result = mysql_query($sql, $objCon) or die(mysql_error());
	while ($data=mysql_fetch_array($result))
	{
		$background_path = $data['path'];
	}
?>


body {
	margin:0 auto 20px auto;
	width: 1280px;
	font-size: 11px;
	font-family: Verdana, Arial, Helvetica, Sans-Serif;
	color: #5D717E;
	background-color: #DDD;
	background-image:url(../<?=$background_path?>) !important;
}
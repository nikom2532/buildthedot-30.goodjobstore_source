<?php
	header('Content-type: text/css');

	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	
	$sql = "SELECT * FROM banner_notice WHERE status=1";
	$result = mysql_query($sql, $objCon) or die(mysql_error());
	while ($data=mysql_fetch_array($result))
	{
		$background_path = $data['path'];
	}
?>

#dashboard{
	float: left;
	color: #000;
	width: 782px;
	min-height: 100px;
	margin: 0px 10px 10px 10px;
	padding: 110px 0 0 0;
	background: url(../<?=$background_path?>) no-repeat top right;
	height: 352px;
	border-left:1px solid #736F6E;
	border-left:1px solid #736F6E;
	padding-left:27px;
}
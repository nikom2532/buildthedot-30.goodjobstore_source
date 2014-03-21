<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	<?
		$strProCode = $_GET["proCode"];
		$strFilterColor = $_GET["filterColor"];
		$strProID = $_GET["proID"];

		$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
		$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
		mysql_query("SET NAMES utf8",$objCon);

		//------- Zoom images ------
		$sql = "select * from images";
			
		if(!$strProID)
		{
			$sql .= " WHERE Product_Code = '$strProCode'
						AND primary_product = 1";
		}
		else
		{
			$sql .= " WHERE Product_ID = '$strProID'";
		}

		if($strFilterColor!=NULL){
			$sql .= " AND Color_ID = '$strFilterColor'";}

		$sql .= " ORDER BY Product_ID,Level
				LIMIT 0 , 1";
		$result = mysql_query($sql, $objCon) or die(mysql_error());
	?>

<!------------------------------------------------------------->

	<?
	while ($data=mysql_fetch_array($result))
	{
	?>
		<div id="testbeta"></div> 
		<div class="clearfix" id="new_data">
			<a href="../../public/<?=$data['Path']?>" class="jqzoom" id="testjqzoom" rel='gal1'  title="" >
				<img id="input_pic" onmouseover="javascript:testtest();" src="../../public/<?=$data['Path_Small']?>"  title="">
			</a>
		</div>  <!-- new_data -->
		<br/>
<?}?>
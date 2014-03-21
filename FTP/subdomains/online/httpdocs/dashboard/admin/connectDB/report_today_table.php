<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>

<?
	//-- session for export to excel --
	session_start(); 
	unset($_SESSION['report_header']);
	unset($_SESSION['report_values']);
	$_SESSION['report_header']=array("Order ID","Create Date","Price"); 

	$start_date = $_GET['start_date'];
	$end_date = $_GET['end_date'];

	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$today = date("Y-m-d");

	$sqlToday = "SELECT Order_ID,Cus_ID,Final_Price,created_at FROM orders
				WHERE Order_Status = 1
				AND (status=2 OR status=3)";
	if(!$start_date and !$end_date)
	{
		$sqlToday .= " AND DATE_FORMAT(created_at,'%Y-%m-%d') = '$today'";
	}
	else
	{
		$sqlToday .= " AND DATE_FORMAT(created_at,'%Y-%m-%d') BETWEEN '$start_date' AND '$end_date'";
	}

	$sqlToday .= " ORDER BY created_at DESC";

	$resultToday = mysql_query($sqlToday, $objCon) or die(mysql_error());
	$TotalPrice = 0;
?>

<div style="text-align:left;">
		<input type="button" style="width:100px;" value="Export to excel" onclick="window.location.href='report_export.php?fn=today_report'">
	<div id="line"></div>
	<br><br><br>
</div>


<table style=" border-collapse:collapse;">
	<tbody>
		<tr style="background-color:#000000; color:#FFFFFF; font-weight:bold; height:25px; text-align:center;">
			<td style="text-align:center; width:180px;">Order</td>
			<td style="text-align:center; width:150px;">Create</td>
			<td style="text-align:right; width:70px;">Price</td>
		</tr>
		<form name="frmTableOrder">
			<?	$i=0;
			while ($dataToday=mysql_fetch_array($resultToday))
			{?>
				<tr style="height:20px;">
					<td>
						<a href="order_detail.php?orderID=<?=$dataToday['Order_ID']?>&cusID=<?=$dataToday['Cus_ID']?>&backTo=1">
						<?=$dataToday['Order_ID']?></a></td>
							<?$_SESSION['report_values'][$i][0]="#".$dataToday['Order_ID'];?>
					<td><?=$dataToday['created_at']?></td>
							<?$_SESSION['report_values'][$i][1]=$dataToday['created_at'];?>
					<td><?=$dataToday['Final_Price']?></td>
						<?$TotalPrice += $dataToday['Final_Price']?>
							<?$_SESSION['report_values'][$i][2]=$dataToday['Final_Price'];?>
				</tr>
			<?	$i++;
			}?>
		</form>
		<tr><td><br></td></tr>
		<tr>
			<td colspan="3" style="text-align:right;">Total Price: <b><?=$TotalPrice?></b> Bath.</td>
							<?$_SESSION['report_values'][$i][0]=" ";?>
							<?$_SESSION['report_values'][$i][1]="Total Price";?>
							<?$_SESSION['report_values'][$i][2]=$TotalPrice;?>
		</tr>
	</tbody>
</table>
<br>
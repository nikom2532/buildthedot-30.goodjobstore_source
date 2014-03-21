<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?
	$cusID = $_GET["cusID"];
	$discount = $_GET["discount"];
	$dis_type = $_GET["dis_type"];
	$exp_day = $_GET["exp_day"];
	$exp_month = $_GET["exp_month"];
	$exp_year = $_GET["exp_year"];
	$exp_date = $exp_year."-".$exp_month."-".$exp_day;

	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	
	$sqlRunCoupon = "SELECT run_coupon FROM coupon ORDER BY run_coupon DESC LIMIT 1";
	$resultRunCoupon = mysql_query($sqlRunCoupon, $objCon) or die(mysql_error());
	while($dataRunCoupon=mysql_fetch_array($resultRunCoupon))
	{ $runCoupon = $dataRunCoupon['run_coupon']+1;}


	if($dis_type==1){
		$discountPC = $discount;}
	else{
		$discountCash = $discount;}
	
	//---------- Gen Date ----------
	$today = date("Y-m-d");

	//-------- Gen coupon ID -------
	$checkCoupon = TRUE;
	
	while($checkCoupon)
	{
		$checkCoupon = FALSE;
		$couponID = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNPQRSTUVWXYZabcdefghijklmnpqrstuvwxyz0123456789',7)),0,7);

		$sqlCheckCoupon = "SELECT Coupon_ID FROM coupon";
		$resultCheckCoupon = mysql_query($sqlCheckCoupon, $objCon) or die(mysql_error());
		while($dataCheckCoupon=mysql_fetch_array($resultCheckCoupon))
		{
			if($dataCheckCoupon['Coupon_ID']==$couponID)
				$checkCoupon = TRUE;
		}
	}

	//-------- Insert table coupon --------
	$sqlCoupon = "INSERT INTO coupon (Coupon_ID,Discount_PC,Discount_Cash,Start_Date,Expired_Date,Discount_Status,run_coupon) 
				VALUES ('".$couponID."','".$discountPC."','".$discountCash."','".$today."','".$exp_date."','".$dis_type."','".$runCoupon."')";
	mysql_query($sqlCoupon, $objCon) or die(mysql_error());

	//-------- Insert table coupon_customers --------
	$sqlCusCoupon = "INSERT INTO coupon_customers (Cus_ID,Coupon_ID,created_at) 
						VALUES ('".$cusID."','".$couponID."','".$today."')";
	mysql_query($sqlCusCoupon, $objCon) or die(mysql_error());

	//------- close database -------
	mysql_close($objCon);
?>
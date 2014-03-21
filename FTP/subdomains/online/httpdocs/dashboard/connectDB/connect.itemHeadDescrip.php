<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<!-- dollar exchange -->
<?
	function google_finance_convert($from_Currency, $to_Currency, $amount) 
	{
		$amount = urlencode($amount);
		$from_Currency = urlencode($from_Currency);
		$to_Currency = urlencode($to_Currency);

		$url = "http://www.google.com/ig/calculator?q=$amount$from_Currency=?$to_Currency";
		$ch = curl_init();
		$timeout = 0;
		curl_setopt ($ch, CURLOPT_URL, $url);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($ch, CURLOPT_USERAGENT , "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$rawdata = curl_exec($ch);
		curl_close($ch);

		$data = explode('"', $rawdata);
		$data = explode(' ', $data[3]);
		$converted = $data[0];

		return sprintf("%02.2f", $converted);
	}
	function cal_rate($rate, $price)
	{
		$sumPrice = $price / $rate;
		return sprintf("%02.2f", $sumPrice);
	}
?>

<?
	$proID = $_GET['proID'];
	$colorID = $_GET['colorID'];
	$proCode = $_GET['proCode'];
	$language = $_GET['language'];

	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

		$sqlRate = "SELECT rate FROM usd_rate LIMIT 1";
		$resultRate = mysql_query($sqlRate, $objCon) or die(mysql_error());
		while ($dataRate = mysql_fetch_array($resultRate))
		{
			$rate = $dataRate['rate'];
		}
/*
	if($colorID!=NULL)
	{
		$sqlDefProduct = "SELECT * FROM images 
						WHERE Color_ID = $colorID
						AND Product_Code = '$proCode'
						ORDER BY Product_ID,Level
						LIMIT 1";
		$resultDefProduct = mysql_query($sqlDefProduct, $objCon) or die(mysql_error());
		while ($dataDefProduct=mysql_fetch_array($resultDefProduct))	
		{
			$proID = $dataDefProduct['Product_ID'];
		}
	}
*/	
	$sql = "SELECT Product_Code,Property_Name,Price_sale,Price_Buy FROM products WHERE Product_ID = '$proID'";
	$result = mysql_query($sql, $objCon) or die(mysql_error());
	
?>

	<?
	while ($data=mysql_fetch_array($result))
	{?>
		<div id="product_id"><?=$data['Product_Code']?><?=$data['Property_Name']?></div>
		<div id="product_line"></div>
		<div id="product_price">

		<?if($data['Price_sale']!=0)
		{?>	
			<span style="text-decoration: line-through; ">
				<?
					if($language=='EN')
						echo "US$ ".cal_rate($rate, $data['Price_Buy']);
					else
						echo $data['Price_Buy']." ฿";
				?>
			</span> 
			&nbsp&nbsp&nbsp&nbsp
			<span style="color:red">
				SALES&nbsp
				<?
					if($language=='EN')
						echo "US$ ".cal_rate($rate, $data['Price_sale']);
					else
						echo $data['Price_sale']." ฿";
				?>
			</span>  
			</span><br /></span>
		<?}
		else if ($data['Price_sale']==0)
		{?>
			<?
				if($language=='EN')
					echo "US$ ".cal_rate($rate, $data['Price_Buy']); 
				else
					echo $data['Price_Buy']." ฿";
			?><br>
		<?}
	}?>
</div>  <!-- product_price -->
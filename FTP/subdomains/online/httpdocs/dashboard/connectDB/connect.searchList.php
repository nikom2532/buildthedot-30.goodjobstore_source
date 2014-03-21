<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<!-- dollar exchange -->
<?
	function google_finance_convert($from_Currency, $to_Currency, $amount) 
	{
		$amount = urlencode($amount);

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
?>

	<?
		$strPage = $_GET["page"];
		$strKeyword = $_GET["keyword"];
		$language = $_GET["language"];

		$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
		$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
		mysql_query("SET NAMES utf8",$objCon);

		//--- No select Main Category
		$sql .= "SELECT * FROM products
					JOIN images ON images.Product_ID = products.Product_ID
					WHERE (products.Pro_Name_En LIKE '%$strKeyword%'
					OR products.Pro_Name_Th LIKE '%$strKeyword%'
					OR products.KeyWord LIKE '%$strKeyword%')
					AND images.Product_ID !=  ''
					AND images.Level = '1'";

		//... End Query ...

		$result = mysql_query($sql, $objCon) or die(mysql_error());		

		$Num_Rows = mysql_num_rows($result);
		
		$Per_Page = 8;
		$Page = $strPage;
		if(!$strPage){
			$Page = 1;
		}

		$Page_Start = (($Per_Page * $Page)-$Per_Page);
		if($Num_Rows <= $Per_Page){
			$Num_Pages=1;
		} else if (($Num_Rows % $Per_Page)==0){
			$Num_Pages=($Num_Rows/$Per_Page);
		} else {
			$Num_Pages=($Num_Rows/$Per_Page)+1;
			$Num_Pages=(int)$Num_Pages;
		}

		$sql .= " order by images.Product_ID  limit $Page_Start , $Per_Page";
		$resultPage = mysql_query($sql, $objCon) or die(mysql_error());
	?>

	<div id="itemWrapper" class="clearfix">
<?
	while ($data = mysql_fetch_array($resultPage))
	{

		if($data['Price_sale']==0){
			$price = $data['Price_Buy'];}
		else{
			$price = $data['Price_sale'];}
?>
		<div class="item">
			<div class="holder_wrap">  
				<div class="holder_wrap_img"> 
					<a href="../category/<?=(!$data['Url_En'])?$data['Pro_Name_En']:$data['Url_En']?>" style="text-decoration:none">
						<img src="<?=$data['Path_Small']?>" style="width:155px; height:116px;" />
					</a>
					<div class="inner_position_right">
					<? if($data['Qty']==0): ?>
							<img src="../public/images/out_of_stock.png" />
					<? elseif($data['attribute_id']==1): ?>
							<img src="../public/images/new_item.png" />
					<? elseif($data['attribute_id']==2): ?>
							<img src="../public/images/hot_item.png" />
					<? elseif($data['attribute_id']==3): ?>
							<img src="../public/images/sale_item.png" />
					<? endif; ?>
					</div>  <!-- inner_position_right  -->
				</div>  <!-- holder_wrap_img -->
			</div> <!-- holder_wrap -->
			<div class="itemProductName"><?=($language=='TH')?$data['Pro_Name_Th']:$data['Pro_Name_En'];?></div> 
			<div class="itemPrice">
				<?
					if($language=='EN')
						echo "US$ ".google_finance_convert("THB", "USD", $price);
					else
						echo $price." ฿";
				?>
			</div>
		</div>  <!-- item -->
<?
	}
?>
	</div>  <!-- itemWrapper -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	<?
	$strProID = $_GET["proID"];
	$strProperty = $_GET["propertyID"];
	$strColorID = $_GET["colorID"];
	$strFilterProp = $_GET["filterProp"];
	if(!$strProperty){
		$strProperty = 1;}
	if(!$strFilterProp){
		$strFilterProp = 1;}
	
	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	//------ Product Description -----------
	$sql = "SELECT Product_ID,Product_Code,Pro_Name_Th,Pro_Name_En,Description_Th,Description_En,Price_Buy,Price_sale,Short_msg_Th,Short_msg_En 
			FROM products
			WHERE Product_ID = '$strProID'";
	$result = mysql_query($sql, $objCon) or die(mysql_error());

	//------ Leather Filter Dropdown -------
	$sqlLeather = "SELECT * FROM property LEFT JOIN images
					ON property.Property_ID = images.Property_ID
					WHERE images.Product_ID = '$strProID'
					OR property.Property_ID = 1
					GROUP BY images.Property_ID";
	$resultLeather = mysql_query($sqlLeather, $objCon) or die (mysql_error());

	//------ Query Dafault Property ((in if)when change image) -------
	if($strProperty == 1)
	{
		$sqlDefProp = "SELECT Property_ID FROM images
						WHERE Product_ID = '$strProID'";

		if($strColorID!=NULL){
			$sqlDefProp .= " AND Color_ID = '$strColorID'";}

		$sqlDefProp .= " ORDER BY Level
						LIMIT 0 , 1";		
		$resultDefProp = mysql_query($sqlDefProp, $objCon) or die (mysql_error());
	}

	//------ Query Default Color ((in if)when filter Leather) ----
	if (!$strColorID)
	{
		$sqlDefCol = "SELECT Color_ID from images
						WHERE Product_ID = '$strProID'";

		if($strFilterProp!=1){
			$sqlDefCol .= " AND Property_ID = '$strFilterProp'";}
						
		$sqlDefCol .= " ORDER BY Level
						LIMIT 0,1";
		$resultDefCol = mysql_query($sqlDefCol, $objCon) or die (mysql_error());
		while ($dataDefCol = mysql_fetch_array($resultDefCol))
		{
			$strColorID = $dataDefCol['Color_ID'];
		}
	}

	//------ Query Cross_Sale -----
	$sqlCross = "SELECT Product_Cross_ID,Thumbnail_path 
				FROM cross_sale LEFT JOIN images 
				ON cross_sale.Product_Cross_ID = images.Product_ID
				WHERE cross_sale.Product_Cross_ID != ''
				AND cross_sale.Product_ID = '$strProID'
				AND images.Level = '1'";
	$resultCross = mysql_query($sqlCross, $objCon) or die(mysql_error());

	?>

<!------------------------------------------------------------------->

	<!-- Head Description -->
		
	<div id="product_head">
		<div class="left">
			<?
			while ($data=mysql_fetch_array($result))
			{?>
			<h1><?echo($data['Pro_Name_En'])?></h1>
				<div id="product_id"><?echo($data['Product_Code'])?></div>
				<div id="product_line"></div>
				<div id="product_price">
					<?if($data['Price_sale']!=0)
					{?>
						<?echo($data['Price_sale'])?> ฿<br />
						instead of <span style="text-decoration: line-through;">
						<?echo($data['Price_Buy'])?> ฿</span><br />
					<?}
					else if ($data['Price_sale']==0)
					{?>
						<?echo($data['Price_Buy'])?> ฿</span><br />
					<?}?>
				</div>
		</div>
		<!-- AddThis Button BEGIN -->
		<div class="right">
			<ul id="social">
				<li><a href="#"><img src="images/facebook.png" /></a></li>
				<li><a href="#"><img src="images/twitter.png" /></a></li>
				<li><a href="#"><img src="images/mail.png" /></a></li>
			</ul>
		</div>
		<!-- AddThis Button END -->
	</div>

	<!-- Description BEGIN -->
	<div id="product_info">
		<div id="scrollbar1">
			<div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
			<div id="product_info">
				<p><?echo($data['Description_En'])?></p>
			</div>
			<div id="product_comment">
				<?echo($data['Short_msg_En'])?>
			</div>
		</div>
	</div>
			<?}?> <!-- End while -->
	<!-- Description End -->



	<!-- Select Color BEGIN -->
	<div id="product_buy">
		<form name="selectFilter" type="" method="">
			<table>
				<tbody>
					<tr>
						<td width="400px" height="60px">
							<a href="javascript:void(0);"  onclick="filterColor(1,<?=$strFilterProp?>)"><img src="images/color_1.jpg"/></a>
							<a href="javascript:void(0);"  onclick="filterColor(2,<?=$strFilterProp?>)"><img src="images/color_2.jpg"/></a>
							<a href="javascript:void(0);"  onclick="filterColor(3,<?=$strFilterProp?>)"><img src="images/color_3.jpg"/></a>
							<a href="javascript:void(0);"  onclick="filterColor(4,<?=$strFilterProp?>)"><img src="images/color_4.jpg"/></a>
							<a href="javascript:void(0);"  onclick="filterColor(5,<?=$strFilterProp?>)"><img src="images/color_5.jpg"/></a>
						</td>
						<td>
							<div class="right">
								<label>Leather :</label>
								<select name="cbo_Leather" onchange="changeLeather()">
										<?
										while ($dataLeather=mysql_fetch_array($resultLeather))
										{
											if ($dataLeather['Property_ID']!=$strFilterProp)
											{?>
												<option value="<?=$dataLeather['Property_ID']?>" title="<?$dataLeather['Name_En']?>">
													<?echo($dataLeather['Name_En'])?>
												</option>
											<?}
											else
											{?>
												<option value="<?=$dataLeather['Property_ID']?>" title="<?$dataLeather['Name_En']?>"
												selected="selected">
													<?echo($dataLeather['Name_En'])?>
												</option>												
											<?}
										}?>
								</select>
							</div>
						</td>
					</tr>
						<?
						if($strProperty != 1){
							$buyProperty = $strProperty;}
						else if($strFilterProp != 1){
							$buyProperty = $strFilterProp;}
						else{
							while ($dataDefProp = mysql_fetch_array($resultDefProp)){
								$buyProperty = $dataDefProp['Property_ID'];}
						}
						
						$sqlCheck = "SELECT * FROM images
									WHERE Product_ID = '$strProID'
									AND Property_ID = '$buyProperty'
									AND Color_ID = '$strColorID'";
						$resultCheck = mysql_query($sqlCheck, $objCon) or die(mysql_error());
						$check=0;
						while ($dataCheck = mysql_fetch_array($resultCheck)){
							$check++;}
						if($check==0){
							$buyProperty='';}
						?>
					<tr>
						<td>
							<a href="../wishlist/add/<?=$strProID?>/<?=$strColorID?>/<?=$buyProperty?>" class="wishlist_button">Add to wishlists</a>
							<a href="../cart/add/<?=$strProID?>/<?=$strColorID?>/<?=$buyProperty?>" class="add_button">+ Add to cart</a>
						</td>
						<td></td>
					</tr>
				</tbody>
			</table>
		</form>
	</div>
	<!-- Select Color END -->



	<!-- Cross Price -->
	<div id="product_like">
		<div class="like_title">
			<div class="backgroundText">PRODUCT YOU MAY LIKE</div>
		</div>
		<div class="img_prod">
			<ul>
				<?
				while ($dataCross=mysql_fetch_array($resultCross))
				{?>
					<li>
						<a href="../item/<?=$dataCross['Product_Cross_ID']?>" style="text-decoration:none">
							<img src="<?=$dataCross['Thumbnail_path']?>"/>
						</a>
					</li>	
				<?}?>
			</ul>
		</div>
	</div>
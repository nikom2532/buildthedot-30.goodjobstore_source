<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	<?
	$strProID = $_GET["proID"];
	$strProCode = $_GET["proCode"];
	$strColorID = $_GET["colorID"];
	$strQtyPro = $_GET["QtyPro"];
	
	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	
	//------ Query Default Color ----
	if (!$strColorID)
	{
		$sqlDefCol = "SELECT Color_ID from images
						WHERE Product_Code = '$strProCode'
						AND primary_product = 1";
		if($strProID!=NULL){
			$sqlDefCol .= " AND Product_ID = '$strProID'";}
						
		$sqlDefCol .= " ORDER BY Product_ID,Level
						LIMIT 0,1";
		$resultDefCol = mysql_query($sqlDefCol, $objCon) or die (mysql_error());
		while ($dataDefCol = mysql_fetch_array($resultDefCol))
		{
			$strColorID = $dataDefCol['Color_ID'];
		}
	}



	//------ find Quantity -------
	if($strProID!=NULL)
	{
		$sqlQty = "SELECT Qty FROM products WHERE Product_ID = '$strProID'";
		$resultQty = mysql_query($sqlQty, $objCon) or die (mysql_error());
		while($dataQty=mysql_fetch_array($resultQty))
		{
			$strQtyPro = $dataQty['Qty'];
		}
	}
	else
	{
		//------ Query Default Product_ID -------
		$sqlDefProduct = "SELECT Product_ID FROM images
						WHERE Product_Code = '$strProCode'
						AND primary_product = 1
						ORDER BY Product_ID,Level
						LIMIT 0 , 1";
		$resultDefProduct = mysql_query($sqlDefProduct, $objCon) or die(mysql_error());
		while ($dataDefProduct = mysql_fetch_array($resultDefProduct))
		{
			$strProID = $dataDefProduct['Product_ID'];
		}
	}

	//------ Query Cross_Sale -----
	$sqlCross = "SELECT Product_Cross_Code,Thumbnail_path,Group_Name_En,Group_Url_En 
				FROM cross_sale
				JOIN product_groups ON cross_sale.Product_Cross_Code = product_groups.Product_Code
				JOIN images ON cross_sale.Product_Cross_Code = images.Product_Code
				WHERE cross_sale.Product_Code =  '$strProCode'
				AND product_groups.Group_Status = '1'
				GROUP BY images.Product_Code";

	$resultCross = mysql_query($sqlCross, $objCon) or die(mysql_error());
/*
	//------- Image Color -------
	$sqlImgColor = "SELECT * FROM color JOIN images
					ON color.Color_ID = images.Color_ID
					WHERE images.Product_ID = '$strProID'";
	$resultImgColor = mysql_query($sqlImgColor, $objCon) or die(mysql_error());
*/
	?>

<!------------------------------------------------------------------->


	<!-- Select Color BEGIN -->
	<div id="product_buy">
			<table>
				<tbody>
				<!--<tr>
						<td width="400px" height="60px">
							<?while($dataImgColor=mysql_fetch_array($resultImgColor))
							{?>
								<a href="javascript:void(0);" onclick="filterColor(<?=$dataImgColor['Color_ID']?>)" style="text-decoration:none;">
									<img src="../../../../public/<?=$dataImgColor['path']?>" title="<?=$dataImgColor['Name_EN']?>"/>
								</a>
							<?}?>
						</td>
					</tr>-->
					<tr>
						<td style="height:40px;">
							<a href="../../../../wishlist/add/<?=$strProID?>/<?=$strColorID?>" class="wishlist_button">ADD TO WISHLIST</a>
						<?php if($strQtyPro==2): ?>
								 <a href="../../../../cart/add/<?=$strProID?>/<?=$strColorID?>" class="add_button">ADD TO CART</a> <span style="color:red;">ONLY 2 LEFT!!</span>
							<?php elseif($strQtyPro==1): ?>
								 <a href="../../../../cart/add/<?=$strProID?>/<?=$strColorID?>" class="add_button">ADD TO CART</a> <span style="color:red;">ONLY 1 LAST!!</span>
							<?php elseif($strQtyPro==0): ?>
								<form method="post" action="../../../../cart/stock_notification" style="margin-bottom:0px !important">
									<span class="outOfStockText">Out of Stock!</span> 
									Email: <input type="text" name="email" id="email" class="emailInputBox" value="" /> <input type="submit" class="emailSubmitButton" value="Submit" />
									<input type="hidden" name="Product_ID" id="Product_ID" value="<?=$strProID?>" />
								</form>
							<?php else: ?>
								<a href="../../../../cart/add/<?=$strProID?>/<?=$strColorID?>" class="add_button">ADD TO CART</a>
							<?php endif; ?>
						</td>
						<td></td>
					</tr>
				</tbody>
			</table>
	</div>
	<!-- Select Color END -->


	<!-- Cross Price -->
	<div id="product_like">
		<div class="like_title">
				<div class="backgroundText"><?if(mysql_num_rows($resultCross)!=0){?>PRODUCTS YOU MAY LIKE<?}?></div>
		</div>
		<div class="img_prod">
			<ul>
				<?
				while ($dataCross=mysql_fetch_array($resultCross))
				{?>
					<li>
						<a href="../../../../category/<?=(!$dataCross['Group_Url_En'])?$dataCross['Group_Name_En']:$dataCross['Group_Url_En']?>" style="text-decoration:none">
							<img src="../../../../public/<?=$dataCross['Thumbnail_path']?>"/>
						</a>
					</li>	
				<?}?>
			</ul>
		</div>
	</div>  <!-- product_like -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<?
		$strPage = $_GET["page"];
		$strMain_64 = $_GET["mainCat"];
		$strMain = base64_decode($strMain_64);
		$strSub_64 = $_GET["subCat"];
		$strSub = base64_decode($strSub_64);
		$strSon_64 = $_GET["sonCat"];
		$strSon = base64_decode($strSon_64);
		$strThumb_64 = $_GET["thumbCat"];
		$strThumb = base64_decode($strThumb_64);
		$strMin = $_GET["min"];
		$strMax = $_GET["max"];
		$strUrl = $_GET["catUrl"];
		$language = $_GET["language"];

		$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
		$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
		mysql_query("SET NAMES utf8",$objCon);

		//--- No select Main Category
		if (!$strMain)
		{
			$sql .= "SELECT * FROM product_groups
					JOIN products ON product_groups.Product_Code = products.Product_Code
					JOIN images ON images.Product_ID = products.Product_ID
					WHERE product_groups.Group_Name_En !=  ''
					AND product_groups.Group_Status = '1'";
		}

		//--- Select Son Category
		else if ($strSon!=NULL)
		{
			$sql .= "SELECT * FROM son_menu
					JOIN category_products ON ( son_menu.Son_ID = category_products.Sub_ID 
						AND category_products.Level =3 )
					JOIN product_groups ON category_products.Product_Code = product_groups.Product_Code
					JOIN products ON product_groups.Product_Code = products.Product_Code
					JOIN images ON images.Product_ID = products.Product_ID
					WHERE son_menu.son_url =  '$strSon'
					AND product_groups.Group_Name_En !=  ''
					AND product_groups.Group_Status = '1'";
		}

		//--- Select Sub Category
		else if ($strSub!=NULL)
		{
			$sql .= "SELECT * FROM sub_menu
					JOIN category_products ON ( sub_menu.Sub_ID = category_products.Sub_ID 
						AND category_products.Level =2 )
					JOIN product_groups ON category_products.Product_Code = product_groups.Product_Code
					JOIN products ON product_groups.Product_Code = products.Product_Code
					JOIN images ON images.Product_ID = products.Product_ID
					WHERE sub_menu.sub_url =  '$strSub'
					AND product_groups.Group_Name_En !=  ''
					AND product_groups.Group_Status = '1'";
		}

		//--- Select Main Category
		else if ($strMain!=NULL)
		{
			$sql .= "SELECT * FROM main_menu
					JOIN category_products ON ( main_menu.main_ID = category_products.Sub_ID 
						AND category_products.Level =1 )
					JOIN product_groups ON category_products.Product_Code = product_groups.Product_Code
					JOIN products ON product_groups.Product_Code = products.Product_Code
					JOIN images ON images.Product_ID = products.Product_ID
					WHERE main_menu.main_url =  '$strMain'
					AND product_groups.Group_Name_En !=  ''
					AND product_groups.Group_Status = '1'";
		}
		//--- select primary product ---
		$sql .= " AND primary_product=1";

		//--- If select Max&Min Price ----
		if ($strMin!=NULL) 
		{
			$sql .= " AND ((products.Price_sale!=0 
						AND products.Price_sale >= $strMin AND products.Price_sale <= $strMax)
					OR (products.Price_sale=0 
						AND products.Price_Buy >= $strMin AND products.Price_Buy <= $strMax))";
		}

		//--- No Same Product ----
			$sql .= " GROUP BY product_groups.Product_Code";

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

		$sql .= " ORDER BY sort LIMIT $Page_Start , $Per_Page";
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
					<a href="../<?=$strUrl?>/<?=(!$data['Group_Url_En'])?$data['Group_Name_En']:$data['Group_Url_En']?>" style="text-decoration:none">
						<img src="../../../../public/<?=$data['Path_Small']?>" style="width:155px; height:116px;" />
					</a>
					<div class="inner_position_right">
					<? if($data['Qty']==0): ?>
							<img src="../../../../public/images/out_of_stock.png" />
					<? elseif($data['Group_attribute_id']==1): ?>
							<img src="../../../../public/images/new_item.png" />
					<? elseif($data['Group_attribute_id']==2): ?>
							<img src="../../../../public/images/hot_item.png" />
					<? elseif($data['Group_attribute_id']==3): ?>
							<img src="../../../../public/images/sale_item.png" />
					<? endif; ?>
					</div>  <!-- inner_position_right  -->
				</div>  <!-- holder_wrap_img -->
			</div> <!-- holder_wrap -->
			<div class="itemProductName"><?=($language=='TH')?$data['Group_Name_Th']:$data['Group_Name_En'];?></div> 
			<div class="itemPrice"><?=($price)?> ฿</div>
		</div>  <!-- item -->
<?
	}
?>
	</div>  <!-- itemWrapper -->
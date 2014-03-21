<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<?
		$strPage = $_GET["page"];
		$strMain = $_GET["mainCat"];
		$strSub = $_GET["subCat"];
		$strMin = $_GET["min"];
		$strMax = $_GET["max"];

		$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
		$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
		mysql_query("SET NAMES utf8",$objCon);

		//--- No select Main Category
		if (!$strMain)
		{
			$sql .= "SELECT * FROM products
					JOIN images ON images.Product_ID = products.Product_ID
					WHERE images.Product_ID !=  ''
					AND products.Pro_Name_En !=  ''
					AND images.Level = '1'";
		}
		//--- Select Sub Category ---
		else if ($strSub!=NULL)
		{
			$sql .= "SELECT * FROM category_products
					JOIN products ON category_products.Product_ID = products.Product_ID
					JOIN images ON images.Product_ID = products.Product_ID
					WHERE category_products.Sub_ID =  $strSub
					AND images.Product_ID !=  ''
					AND products.Pro_Name_En !=  ''
					AND images.Level = '1'";
		}
		//--- Select Main Category with out Sub Category ---
		else if (!$strSub)
		{
			$sql .= "SELECT * FROM main_menu
					JOIN sub_menu ON main_menu.main_ID = sub_menu.Main_ID
					JOIN category_products ON sub_menu.Sub_ID = category_products.Sub_ID
					JOIN products ON category_products.Product_ID = products.Product_ID
					JOIN images ON images.Product_ID = products.Product_ID
					WHERE main_menu.main_ID = $strMain
					AND images.Product_ID !=  ''
					AND products.Pro_Name_En !=  ''
					AND images.Level = '1'";
		}

		//--- If select Max&Min Price ----
		if ($strMin!=NULL) 
		{
			$sql .= " AND ((products.Price_sale!=0 
						AND products.Price_sale >= $strMin AND products.Price_sale <= $strMax)
					OR (products.Price_sale=0 
						AND products.Price_Buy >= $strMin AND products.Price_Buy <= $strMax))";
		}

		//--- No Same Product ----
		if (!$strSub)
		{
			$sql .= " GROUP BY products.Product_ID";
		}

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

		for ($i=1;$i<=$Num_Pages;$i++)
			{
				if ($i != $Page)
				{
					echo("<a href=\"JavaScript:viewList('$i');viewNav('$i')\">$i</a>");
				} 
				else 
				{
					echo("<a href=\"JavaScript:viewList('$i');viewNav('$i')\" class=\"active\">$i</a>");
				}
			}
	?>
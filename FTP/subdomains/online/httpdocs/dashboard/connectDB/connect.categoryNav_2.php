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
		$converted = rawurlencode($converted);
		$converted = str_replace ("%C2%A0",'',$converted);
		return sprintf("%02.2f", $converted);
	}
?>

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

		if($language=='EN' AND $strMin!='')
		{
			$strMin = google_finance_convert("USD", "THB", $strMin);
			$strMax = google_finance_convert("USD", "THB", $strMax);
		}

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
		if($Num_Rows <= $Per_Page)
		{
			$Num_Pages = 1;
		}
		else if (($Num_Rows % $Per_Page) == 0)
		{
			$Num_Pages = ($Num_Rows/$Per_Page);
		} 
		else 
		{
			$Num_Pages = ($Num_Rows/$Per_Page) + 1;
			$Num_Pages = (int)$Num_Pages;
		}

		$sql .= " ORDER BY sort LIMIT $Page_Start , $Per_Page";
		$resultPage = mysql_query($sql, $objCon) or die(mysql_error());
		
		if($Num_Pages != 1)
		{
			for ($i=1;$i<=$Num_Pages;$i++)
			{
					$strMain_64 = base64_encode($strMain);
					$strSub_64 = base64_encode($strSub);
					$strSon_64 = base64_encode($strSon);
					$strThumb_64 = base64_encode($strThumb);
					if ($i != $Page)
					{
						echo("<a href=\"JavaScript:viewList('$i','$strMain_64','$strSub_64','$strSon_64','$strThumb_64','$strMin','$strMax','$strUrl','$language');viewNav('$i','$strMain_64','$strSub_64','$strSon_64','$strThumb_64','$strMin','$strMax','$strUrl','$language')\">$i</a>");
					} 
					else 
					{
						echo("<a href=\"JavaScript:viewList('$i','$strMain_64','$strSub_64','$strSon_64','$strThumb_64','$strMin','$strMax','$strUrl','$language');viewNav('$i','$strMain_64','$strSub_64','$strSon_64','$strThumb_64','$strMin','$strMax','$strUrl','$language')\" class=\"active\">$i</a>");
					}
			 }
		}
	?>
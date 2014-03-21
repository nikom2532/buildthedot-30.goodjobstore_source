<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<meta http-equiv=Content-Type content="text/html; charset=utf-8">

<?
	$proCode = $_GET['proCode'];
	$proNameEN = $_GET['proNameEN'];
	$step = $_GET['step'];

	//include_once '../classes/Products.php';
	//Initialization
	include_once '../classes/Employees.php';
	$login = 'Log in';
	$logout = 'Register';
	$link = 'profile.php';
		$get_empid = '0001';
		//$get_empid = $_GET['id'];
		$getemp = new Employees();
		$get = $getemp->emp($get_empid);
		$getlastname = $getemp->getLastName();
		$getemail = $getemp->getEmail();
		$login = $getemp->getFirstName()." ".$getemp->getLastName();
		$logout = 'Log out';
		if(isset($getfirstname)==0&&isset($getlastname)==0)
			{
				$login = $getemp->getEmail();
			} 
?>
<!--Permission-->

<?php
session_start(); //เปิด session
$ses_userid =$_SESSION[ses_userid];
$ses_username = $_SESSION[ses_username];
if($ses_userid <> session_id() or $ses_username =="")
{
echo "Please Login to system<br />";
}

if($_SESSION[ses_status] != "Super Admin") 
{
echo "This page for Super Admin only!";
echo "<br><a href=index.php>Back</a>";
exit();
}
?>

<!--Permission-->


<html>
<head>
	<title>GOODJOB - Administration</title>
	<link rel="stylesheet" type="text/css" href="../css/reset.css">
	<link rel="stylesheet" type="text/css" href="../css/mainstyle.css">
	<link rel="stylesheet" type="text/css" href="../css/admin.css">

	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script src="ajax/ajax.productGroup.java"></script>

	<?
		$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
		$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
		mysql_query("SET NAMES utf8",$objCon);			

		//-------- cross sale SELECTED product
		$sqlCross = "SELECT * FROM cross_sale JOIN product_groups 
					ON cross_sale.Product_Code = product_groups.Product_Code
					WHERE product_groups.Product_Code =  '$proCode'
					ORDER BY cross_sale.Product_Cross_Code";
		$resultCross = mysql_query($sqlCross, $objCon) or die(mysql_error());
	?>				

</head>
<body>

<!--logout-->

	<div id="wrapper">
		<div id="header">
			<div class="logo"><a href ="http://online.goodjobstore.com"><img src="../images/logo.jpg" /></a></div>
			<div class="right">
				<ul class="member_style">
					
					<li><a href="logout.php">log out</a></li>
				</ul>
			</div>
		</div>
		
<!--logout-->

		
		<!-- Body Section -->
		<div id="title_head">
		Back Office
		</div>
		<div id="content">
		    <div id="leftcolum">

<!--menu-->

									<b><a href="order.php">Order</a></b>
								<?if($_SESSION[ses_status] == "Super Admin") 
			{?>
								<!-- End Admin -->
									<b><br><br><a href="saleReport.php">Sale Report</a>
									<br><br><a href="record.php">Customer Record</a>
									<br><br><a href="productGroup.php">Product</a>
									<br><br><a href="category.php">Category</a>
									<br><br><a href="property.php">Property</a>
									<br><br><a href="color.php">Color</a>
									<br><br><a href="banner.php">Banner</a>
									<br><br><a href="banner_notice.php">Notice Banner</a>
									<br><br><a href="slide.php">Slide</a>
									<br><br><a href="background.php">Background</a>
									<br><br><a href="giftwarp.php">Gift warp price</a>
									<br><br><a href="shipper.php">Shipper</a>
									<br><br><a href="cusGroup.php">Group Customers</a>
									<br><br><a href="freeShip.php">Free Shipping</a>
									<br><br><a href="payment.php">Payment</a>
									<br><br><a href="shopGuide_main.php">Shopping Guide</a>
									<br><br><a href="privacy.php">Permission</a>
									<br><br><a href="usdRate.php">USD Rate</a></b>
			<?}?>	

<!--menu-->
		   	</div>
			<div id="dashboard"> 
	
					<div class="viewport">
						<div class="overview">
							<h2>Edit Categories and Cross Product</h2>
							<b>Code:&nbsp&nbsp<?=$proCode?>
							<br>
							Name:&nbsp<?=$proNameEN?></b>
							<br><br><br>
<div style="width: 800px; height: 400px; overflow: auto; padding: 5px">

							<!---------- category product ------>
								<?
								//----- Main menu -----
								$sqlMain = "SELECT * FROM main_menu";
								$resultMain = mysql_query($sqlMain, $objCon) or die(mysql_error());
								while ($dataMain=mysql_fetch_array($resultMain))
								{
									$mainID = $dataMain['main_ID'];
								?>

									<input type="checkbox" name="checkMain" id="checkMain_<?=$dataMain['main_ID']?>" value="<?=$dataMain['main_ID']?>"
											onclick="selectMain('<?=$dataMain['main_ID']?>','<?=$proCode?>');"
												<?
												$sqlCheckMain = "SELECT id FROM category_products WHERE Product_Code='$proCode' AND Sub_ID='$mainID' AND Level='1'";
												$resultCheckMain = mysql_query($sqlCheckMain, $objCon) or die(mysql_error());
												while ($dataCheckMain=mysql_fetch_array($resultCheckMain))
												{?>
														<?if($resultCheckMain!=NULL){?>checked<?}?>
												<?}?>
									>
									
										<?=$dataMain['Name_En']?><br><br>
									<?
									//----- Sub menu ------
									$sqlSub = "SELECT * FROM sub_menu WHERE Main_ID = $mainID";
									$resultSub = mysql_query($sqlSub, $objCon) or die(mysql_error());
									while($dataSub=mysql_fetch_array($resultSub))
									{
										$subID = $dataSub['Sub_ID'];
									?>
										&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
										<input type="checkbox" name="checkSub" id="checkSub_<?=$dataSub['Sub_ID']?>" value="<?=$dataSub['Sub_ID']?>"
												onclick="selectSub('<?=$dataSub['Sub_ID']?>','<?=$proCode?>');"
													<?
													$sqlCheckSub = "SELECT id FROM category_products WHERE Product_Code='$proCode' AND Sub_ID='$subID' AND Level='2'";
													$resultCheckSub = mysql_query($sqlCheckSub, $objCon) or die(mysql_error());
													while ($dataCheckSub=mysql_fetch_array($resultCheckSub))
													{?>
															<?if($dataCheckSub!=NULL){?>checked<?}?>
													<?}?>
										>
										<?=$dataSub['Name_En']?><br><br>
										
										<?
										//----- Son menu ------
										$sqlSon = "SELECT * FROM son_menu WHERE Sub_ID = $subID";
										$resultSon = mysql_query($sqlSon, $objCon) or die(mysql_error());
										while($dataSon=mysql_fetch_array($resultSon))
										{
											$sonID = $dataSon['Son_ID'];
										?>
											&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
											<input type="checkbox" name="checkSon" id="checkSon_<?=$dataSon['Son_ID']?>" value="<?=$dataSon['Son_ID']?>"
													onclick="selectSon('<?=$dataSon['Son_ID']?>','<?=$proCode?>');"
														<?
														$sqlCheckSon = "SELECT id FROM category_products WHERE Product_Code='$proCode' AND Sub_ID='$sonID' AND Level='3'";
														$resultCheckSon = mysql_query($sqlCheckSon, $objCon) or die(mysql_error());
														while ($dataCheckSon=mysql_fetch_array($resultCheckSon))
														{?>
																<?if($dataCheckSon!=NULL){?>checked<?}?>
														<?}?>
											>
											<?=$dataSon['Name_En']?><br><br>
											
											<?
											//----- Thumb menu ------
											$sqlThumb = "SELECT * FROM thumb_menu WHERE Son_ID = $sonID";
											$resultThumb = mysql_query($sqlThumb, $objCon) or die(mysql_error());
											while($dataThumb=mysql_fetch_array($resultThumb))
											{
												$thumbID = $dataThumb['Thumb_ID'];
											?>
												&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
												<input type="checkbox" name="checkThumb" id="checkThumb_<?=$dataThumb['Thumb_ID']?>" value="<?=$dataThumb['Thumb_ID']?>"
														onclick="selectThumb('<?=$dataThumb['Thumb_ID']?>','<?=$proCode?>');"
															<?
															$sqlCheckThumb = "SELECT id FROM category_products WHERE Product_Code='$proCode' AND Sub_ID='$thumbID' AND Level='4'";
															$resultCheckThumb = mysql_query($sqlCheckThumb, $objCon) or die(mysql_error());
															while ($dataCheckThumb=mysql_fetch_array($resultCheckThumb))
															{?>
																	<?if($dataCheckThumb!=NULL){?>checked<?}?>
															<?}?>
												>
												<?=$dataThumb['Name_En']?><br><br>
											<?}
										}
									}
								}?>
							<!--------- end category -------------->

							<br>
							<div id="line"></div>
							<br>
								<!----------- Cross Product ----------->
									<form name="frmAddProduct">
										<?$i=0;
										while($dataCross=mysql_fetch_array($resultCross))
										{$i++;?>
											<tr>
												<td>Cross Product <?=$i?></td>
												<td><img src="../images/dot.gif" /></td>
												<td>
													<div id="cross_product<?=$i?>">
														<select name="selectCross<?=$i?>">
															<option value=""><-- Please Select Cross Product <?=$i?>--></option>
															<?//-------- show all product -----
															$sqlCrossAll = "SELECT * FROM product_groups WHERE Product_Code!='$proCode'";
															$resultCrossAll = mysql_query($sqlCrossAll, $objCon) or die(mysql_error());
															while ($dataCrossAll=mysql_fetch_array($resultCrossAll))
															{?>
																<option value="<?=$dataCrossAll['Product_Code']?>"
																	<?if($dataCrossAll['Product_Code']==$dataCross['Product_Cross_Code'])
																	{?>selected<?}?>
																>
																	<?=$dataCrossAll['Group_Name_En']?>
																</option>
															<?}?>
														</select>
													</div>
												</td>
											</tr>
										<?}
										
										if($i!=4)
										{
											for($j=$i+1;$j<=4;$j++)
											{?>
												<tr>
													<td>Cross Product <?=$j?></td>
													<td><img src="../images/dot.gif" /></td>
													<td>
														<div id="cross_product<?=$j?>">
															<select name="selectCross<?=$j?>">
																<option value=""><-- Please Select Cross Product <?=$j?>--></option>
																<?//-------- show all product -----
																$sqlCrossAll = "SELECT * FROM product_groups WHERE Product_Code!='$proCode'";
																$resultCrossAll = mysql_query($sqlCrossAll, $objCon) or die(mysql_error());
																while ($dataCrossAll=mysql_fetch_array($resultCrossAll))
																{?>
																	<option value="<?=$dataCrossAll['Product_Code']?>">
																		<?=$dataCrossAll['Group_Name_En']?>
																	</option>
																<?}?>
															</select>
														</div>
													</td>
												</tr>
											<?}
										}?>
									</form>
							<!-- end cross product -->
							</div>
							<br>
						<?if($step==1){?>
							<input type="button" style="width:60px;" value="Next" onclick="updateCross('<?=$proCode?>',1)"><?}
						else{?>
							<input type="button" style="width:60px;" value="Update" onclick="updateCross('<?=$proCode?>',2)"><?}?>
							<input type="button" style="width:60px;" value="Cancel" onclick="window.location.href='productGroup.php'">
							<div id="test_content"></div>
					
					</div>
				</div>	
			</div>
		</div> <!-- End Content -->       
		
	<!-- Footer Section -->
		<div id="footer">
			<div class="payment_logo"><img src="../images/payment_logo.jpg" /></div>
			<div class="copyright">? 2011 - 2015 GOODJOB CO., LTD</div>
		</div>
	
	</div>
</body>
</html>

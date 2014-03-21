<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?
	$genProID = $_GET['genProID'];

	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);			
?>

	<script type="text/javascript"> 
		function showMe (it, box) 
		{ 
		  var vis = (box.checked) ? "block" : "none"; 
		  document.getElementById(it).style.display = vis;
		} 
	</script>


	<?
	//----- Main menu -----
	$sqlMain = "SELECT * FROM main_menu";
	$resultMain = mysql_query($sqlMain, $objCon) or die(mysql_error());
	
	$runMain=0;
	while ($dataMain=mysql_fetch_array($resultMain))
	{?>
		<input type="checkbox" 
			name="checkMain" 
			id="checkMain_<?=$dataMain['main_ID']?>"
			onclick="selectMain('<?=$dataMain['main_ID']?>','<?=$genProID?>'); 
					showMe('hide_sub<?=$runMain?>', this);" 
			value="<?=$dataMain['main_ID']?>">
		<?=$dataMain['Name_En']?><br><br>

		<div id="hide_sub<?=$runMain?>" style="display:none">
			<?
			//----- Sub menu ------
			$mainID = $dataMain['main_ID'];
			$sqlSub = "SELECT * FROM sub_menu WHERE Main_ID = $mainID";
			$resultSub = mysql_query($sqlSub, $objCon) or die(mysql_error());

			$runSub=0;
			while($dataSub=mysql_fetch_array($resultSub))
			{?>
				&nbsp; &nbsp; &nbsp;
				<input type="checkbox" 
						name="checkSub" 
						id="checkSub_<?=$dataSub['Sub_ID']?>"
						onclick="selectSub('<?=$dataSub['Sub_ID']?>','<?=$genProID?>');
								showMe('hide_son<?=$runMain?><?=$runSub?>', this)"
						value="<?=$dataSub['Sub_ID']?>">
				<?=$dataSub['Name_En']?><br><br>

				<div id="hide_son<?=$runMain?><?=$runSub?>" style="display:none">
					<?
					//----- Son menu ------
					$subID = $dataSub['Sub_ID'];
					$sqlSon = "SELECT * FROM son_menu WHERE Sub_ID = $subID";
					$resultSon = mysql_query($sqlSon, $objCon) or die(mysql_error());

					$runSon=0;
					while($dataSon=mysql_fetch_array($resultSon))
					{?>
						&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
						<input type="checkbox" 
						name="checkSon" 
						id="checkSon_<?=$dataSon['Son_ID']?>"
						onclick="selectSon('<?=$dataSon['Son_ID']?>','<?=$genProID?>');
								showMe('hide_thumb<?=$runMain?><?=$runSub?><?=$runSon?>', this)" 
						value="<?=$dataSon['Son_ID']?>">
						<?=$dataSon['Name_En']?><br><br>

						<div id="hide_thumb<?=$runMain?><?=$runSub?><?=$runSon?>" style="display:none">
							<?
							//----- Thumb menu ------
							$sonID = $dataSon['Son_ID'];
							$sqlThumb = "SELECT * FROM thumb_menu WHERE Son_ID = $sonID";
							$resultThumb = mysql_query($sqlThumb, $objCon) or die(mysql_error());

							while($dataThumb=mysql_fetch_array($resultThumb))
							{?>
								&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
								<input type="checkbox" 
										name="checkThumb" 
										id="checkThumb_<?=$dataThumb['Thumb_ID']?>"
										onclick="selectThumb('<?=$dataThumb['Thumb_ID']?>','<?=$genProID?>');" 
										value="<?=$dataThumb['Thumb_ID']?>">
								<?=$dataThumb['Name_En']?><br><br>
							<?}?>
						</div>
					<?$runSon++;
					}?>
				</div>
			<?$runSub++;
			}?>
		</div>
	<?$runMain++;
	}?>
<!-- START nivo slider  -->
	<script type="text/javascript" src="<?=base_url()?>public/scripts/jquery.nivo.slider.pack.js"></script>
    <script type="text/javascript">
    	$(document).ready(function() {
    		$('#slider').nivoSlider();
    	});
    </script>
	<!--  END nivo slider-->    

<?
	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);
	
	//------ promotion -----
	$sqlPromotion = "SELECT * FROM promotions WHERE status='1'";
	$resultPromotion = mysql_query($sqlPromotion, $objCon) or die(mysql_error());

	//------ slide -----
	$sqlSlide = "SELECT * FROM slide WHERE status='1'";
	$resultSlide = mysql_query($sqlSlide, $objCon) or die(mysql_error());

	//------ banner -----
	$sqlBanner = "SELECT * FROM banner WHERE status='1'";
	$resultBanner = mysql_query($sqlBanner, $objCon) or die(mysql_error());

?>

<div id="section" class="clearfix">

	<!--<?php if($promotions['status']==1): ?>
		<div id="promotion">
			<div class="promo-head"><?=(LANG=='TH')?$promotions['data']->name_th:$promotions['data']->name_en;?></div>
				<center><img src="<?=base_url()?>public/<?=$promotions['data']->path?>"  style="width:1000px;height:30px;"/></center>
			<div class="promo-footer"></div>
		</div>
	<?php endif; ?>
-->

	<?while($dataPromotion=mysql_fetch_array($resultPromotion))
	{?>
		<div id="promotion">
				<center><img src="<?=base_url()?>public/<?=$dataPromotion['path']?>"  style="width:1000px;height:30px;"/></center>
		</div>
	<?}?>


	<!-- Article Section -->
	<div id="article">
		<div class="slider-wrapper theme-default">
	        <div class="ribbon"></div>
	            <div id="slider" class="nivoSlider">
					<?while($dataSlide=mysql_fetch_array($resultSlide))
					{
						if(!$dataSlide['url'] OR $dataSlide['url']=='') {?>
							<img src="<?=base_url()?>public/<?=$dataSlide['path']?>" alt='' height="470" />
						<?}
						else {?>
							<a href= "<?=$dataSlide['url']?>"><img src="<?=base_url()?>public/<?=$dataSlide['path']?>" alt='' height="470" /></a>
						<?}?>
					<?}?>
	            </div>
		</div>
	</div>
	
	<!-- Aside Section -->
	<div id="aside">
		<!--	<ul>
					<?php foreach($banners as $key => $banner): ?>
						<li <?=($key==0)?"class='boarder_img'":''?>>
							<img src='<?=base_url()?>public/<?=$banner->Thumbnail_path?>' class='center' />
						</li>
					<?php endforeach; ?>
				</ul>	-->
		<ul>
			<?while($dataBanner=mysql_fetch_array($resultBanner))
			{?>
				<li>
					<?if(!$dataBanner['url'] OR $dataBanner['url']=='') {?>
						<img src="<?=base_url()?>public/<?=$dataBanner['path']?>" class='center'/>
					<?}
					else {?>
						<a href="<?=$dataBanner['url']?>"><img src="<?=base_url()?>public/<?=$dataBanner['path']?>" class='center'/></a>
					<?}?>
				</li>
			<?}?>
		</ul>
	</div>
</div>
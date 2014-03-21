<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>GOODJOB</title>
	<meta name="keywords" content="shop, prestashop">
	<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8">
	<meta name="generator" content="GoodJobStore">

	<!--[if lt IE 7 ]> <html class="ie"> <![endif]-->
	<!--[if IE 7 ]>    <html class="ie"> <![endif]-->
	<!--[if IE 8 ]>    <html class="ie"> <![endif]-->
	<!--[if IE 9 ]>    <html class="ie"> <![endif]-->
	<!--[if (gt IE 9)|!(IE)]><!--> <html class=""> <!--<![endif]-->

	<link rel="icon" type="<?=base_url()?>public/image/vnd.microsoft.icon" href="<?=base_url()?>public/images/favicon.png">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/background.php">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/reset.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/mainstyle.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/menu.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/slidestyle.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/default.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/nivo-slider.css">
	
	<script type="text/javascript" src="<?=base_url()?>public/scripts/jquery-1.7.2.min.js"></script>

	<!-- <script type="text/javascript" src="<?=base_url()?>public/scripts/droplinemenu.js"></script>
	<script type="text/javascript">
		droplinemenu.buildmenu("droplinetabs1")
	</script> -->

	<script>
		$(document).ready(function() {
			$("#displayText").click(function () {
				$(".toggleText").toggle();
				return false;
			});
		});
	</script>
	

	<!-- START jQuery & Menu Style Code -->
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/ddsmoothmenu.css" />
	<script type="text/javascript" src="<?=base_url()?>public/scripts/ddsmoothmenu.js"></script>

		<script type="text/javascript">
		ddsmoothmenu.init({
			mainmenuid: "smoothmenu1", //menu DIV id
			orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
			classname: 'ddsmoothmenu', //class added to menu's outer DIV
			contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
		})
		</script>
<!-- END jQuery & Menu Style Code -->


<!-- Google analytics -->
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-10211107-1']);
  _gaq.push(['_setDomainName', 'goodjobstore.com']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

</head>
<body>
	<div id="wrapper">
		<!-- Header Section -->
		<?=$this->load->view('templates/header')?>
		<?php if(!$this->session->userdata('lang')): ?>
			<?//=$this->load->view('templates/overlay')?>
		<?php endif; ?>
		
		<!-- Body Section -->
		<?=$contents?>

		<!-- Footer Section -->
		<?=$this->load->view('templates/footer')?>
	</div>
</body>
</html>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Plat-BO</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />

	<link href="<?=base_url()?>public/css/styles.css" rel="stylesheet" type="text/css" />
	<!--[if IE]> <link href="css/ie.css" rel="stylesheet" type="text/css"> <![endif]-->

	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/min/jquery-1.8.3.min.js"></script> 
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/min/jquery-ui-1.9.2.js"></script>

	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/charts/excanvas.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/charts/jquery.sparkline.min.js"></script>

	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/tables/jquery.dataTables.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/tables/jquery.sortable.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/tables/jquery.resizable.js"></script>

	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/forms/jquery.autosize.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/forms/jquery.uniform.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/forms/jquery.inputlimiter.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/forms/jquery.tagsinput.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/forms/jquery.maskedinput.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/forms/jquery.autotab.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/forms/jquery.select2.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/forms/jquery.dualListBox.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/forms/jquery.cleditor.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/forms/jquery.ibutton.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/forms/jquery.validationEngine-en.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/forms/jquery.validationEngine.js"></script>

	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/uploader/plupload.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/uploader/plupload.html4.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/uploader/plupload.html5.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/uploader/jquery.plupload.queue.js"></script>

	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/wizards/jquery.form.wizard.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/wizards/jquery.validate.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/wizards/jquery.form.js"></script>

	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/ui/jquery.collapsible.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/ui/jquery.breadcrumbs.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/ui/jquery.tipsy.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/ui/jquery.progress.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/ui/jquery.timeentry.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/ui/jquery.colorpicker.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/ui/jquery.jgrowl.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/ui/jquery.fancybox.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/ui/jquery.fileTree.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/ui/jquery.sourcerer.js"></script>

	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/others/jquery.fullcalendar.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/others/jquery.elfinder.js"></script>

	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/forms/jquery.mousewheel.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/ui/jquery.easytabs.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/files/bootstrap.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/files/functions.js"></script>

	<script type="text/javascript" src="<?=base_url()?>public/js/charts/jsapi.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/charts/gadash-1.0.js"></script>
	
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/others/jquery.confirm.js"></script>

	<!---- Drag And Drop ---->
	<script src="<?=base_url()?>public/js/plugins/draganddrop/jquery.tablednd.js"></script>
	<script src="<?=base_url()?>public/js/plugins/draganddrop/jqueryTableDnDArticle.js"></script>
	<!---- End Drag And Drop -->
</head>

<body>
	<div id="wrapper">
		<!-- Header Section -->
		<?=$this->load->view('templates/header')?>
		
		<!-- Body Section -->
		<?=$contents?>

		<!-- Footer Section -->
		<?=$this->load->view('templates/footer')?>
	</div>
</body>
</html>


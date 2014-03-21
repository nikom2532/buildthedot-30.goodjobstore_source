<script language="JavaScript">
	var jArray = [ "One", "Two", "Three"];
	var url = "<?=base_url();?>";
    //document.location="http://backoffice.planetlanka.com/customer/blah.php?test=" + jArray;
	
	$.ajax({
		type: 'POST',
		url: url+'category/blah',
		data: 'test='+jArray,
		success: function(data){
			$('ffff').html(data);
		}
	});

/*
	$.ajax({
		type: "POST",
		url: url+'category/blah',
		data: jArray
		}).done(function( msg ) {
		alert( "Data Saved: " + msg );
		});
*/
</script>

<div id="ffff"></div>
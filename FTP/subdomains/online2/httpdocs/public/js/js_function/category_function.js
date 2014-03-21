function select_level(url, sel_lv1)
{
	var sel_lv = $('#sel_lv').val();
	if(sel_lv1=="")
		sel_lv1 = '0';
	$.ajax({
		type: 'POST',
		url: url+'category/select_level',
		data: 'sel_lv='+sel_lv+"&sel_lv1="+sel_lv1,
		success: function(data){
			$('#field_main').html(data);
		}
	});
}

function select_main(url, sel_lv1_default, sel_lv2)
{
	var sel_lv = $('#sel_lv').val();
	var sel_lv1 = $('#sel_lv1').val();
	if (sel_lv1 == null)
		sel_lv1 = sel_lv1_default;
	if(sel_lv2=="")
		sel_lv2 = '0';
	$.ajax({
		type: 'POST',
		url: url+'category/select_main',
		data: 'sel_lv='+sel_lv+"&sel_lv1="+sel_lv1+"&sel_lv2="+sel_lv2,
		success: function(data){
			$('#field_sub').html(data);
		}
	});
}
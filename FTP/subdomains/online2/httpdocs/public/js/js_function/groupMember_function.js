function select_level(url, sel_lv1)
{
	var jArray = [ "One", "Two", "Three"];
	var TTT = 'testtest';
	var url = "http://backoffice.planetlanka.com/";
	/*
	$.ajax({
		type: 'POST',
		url: url+'category/blah',
		data: 'test='+jArray;
		}
	});
	*/
	$.ajax({
		type: 'POST',
		url: url+'category/blah',
		data: 'test='+TTT,
		success: function(data){
			$('#field_main').html(data);
		}
	});
}
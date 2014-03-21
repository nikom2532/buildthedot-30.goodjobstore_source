<?
	//----- Main nav -----
	$data['active_menu'] = '2';
	echo $this->load->view('templates/main_menu', $data);
	
	//----- Secondary nav -----
	$btn_menu[] = array('btn_menu'=>'BUTTON', 'link_menu'=>base_url('statistic'), 'icon'=>'icon-plus-2');
	$btn_menu[] = array('btn_menu'=>'AUTHORIZE ANALYTICS', 'link_menu'=>base_url(''), 'btn_id'=>'authorize-button', 'btn_style'=>'visibility: hidden');
	//<a title="" class="sideB bBlue mt10" id="authorize-button" style="visibility: hidden">Authorize Analytics</a>

	$data['sec_menu'] = array('btn_menu'=>$btn_menu);

	echo $this->load->view('templates/second_menu', $data);
?>
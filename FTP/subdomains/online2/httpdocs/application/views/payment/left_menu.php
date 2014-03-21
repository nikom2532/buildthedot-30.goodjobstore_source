<?
	//----- Main nav -----
	$data['active_menu'] = '8';
	echo $this->load->view('templates/main_menu', $data);
	
	//----- Secondary nav -----
	$btn_menu[] = array('btn_menu'=>'ADD PAYMENT', 'link_menu'=>base_url('payment/create'), 'icon'=>'icon-plus-2');
	$data['sec_menu'] = array('btn_menu'=>$btn_menu);

	echo $this->load->view('templates/second_menu', $data);
?>
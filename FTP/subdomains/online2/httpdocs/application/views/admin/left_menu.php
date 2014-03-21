<?
	//----- Main nav -----
	$data['active_menu'] = '11';
	echo $this->load->view('templates/main_menu', $data);
	
	//----- Secondary nav -----
	$btn_menu[] = array('btn_menu'=>'ADD ADMIN', 'link_menu'=>base_url('admin/create'), 'icon'=>'icon-plus-2');
	$data['sec_menu'] = array('btn_menu'=>$btn_menu);

	echo $this->load->view('templates/second_menu', $data);
?>
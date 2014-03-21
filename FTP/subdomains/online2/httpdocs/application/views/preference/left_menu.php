<?
	//----- Main nav -----
	$data['active_menu'] = '13';
	echo $this->load->view('templates/main_menu', $data);
	
	//----- Secondary nav -----
	$btn_menu[] = array('btn_menu'=>'COLOR', 'link_menu'=>base_url('preference/color'));
	$btn_menu[] = array('btn_menu'=>'PROPERTY', 'link_menu'=>base_url('preference/property'));
	$btn_menu[] = array('btn_menu'=>'ATTRIBUTE', 'link_menu'=>base_url('preference/attribute'));
	$btn_menu[] = array('btn_menu'=>'KEYWORD', 'link_menu'=>base_url('preference/keyword'));
	$btn_menu[] = array('btn_menu'=>'KEYWORD GROUP', 'link_menu'=>base_url('preference/keyword_group'));
	$data['sec_menu'] = array('btn_menu'=>$btn_menu);

	echo $this->load->view('templates/second_menu', $data);
?>
<?
	//----- Main nav -----
	$data['active_menu'] = '6';
	echo $this->load->view('templates/main_menu', $data);
	
	//----- Secondary nav -----
	if(!isset($shipping_detail))
	{
		$btn_menu[] = array('btn_menu'=>'ADD SHIPPING', 'link_menu'=>base_url('shipping/create'), 'icon'=>'icon-plus-2');
		//$btn_menu[] = array('btn_menu'=>'MANAGE SHIPPING', 'link_menu'=>base_url('shipping'));
	}
	else
	{
		$btn_menu[] = array('btn_menu'=>'ADD SHIPPING RANGE', 'link_menu'=>base_url('shipping/range/'.$shipping_detail->shipping_id.'/create'), 'icon'=>'icon-plus-2');
	}

	$data['sec_menu'] = array('btn_menu'=>$btn_menu);

	echo $this->load->view('templates/second_menu', $data);
?>
<?
	//----- Main nav -----
	$data['active_menu'] = '3';
	echo $this->load->view('templates/main_menu', $data);
	
	//----- Secondary nav -----
	$btn_menu[] = array('btn_menu'=>'ADD ORDER', 'link_menu'=>base_url('order/create'), 'icon'=>'icon-plus-2');

	if(isset($order_detail))
	{
		//----- Secondary nav -----
		$btn_menu[] = array('btn_menu'=>'CHANGE STATUS', 'link_menu'=>base_url('order/status/'.$order_detail->order_id));
	}

	$data['sec_menu'] = array('btn_menu'=>$btn_menu);

	echo $this->load->view('templates/second_menu', $data);
?>
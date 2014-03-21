<?
	//----- Main nav -----
	$data['active_menu'] = '4';
	echo $this->load->view('templates/main_menu', $data);
	
	if(!isset($group_detail) AND !isset($group_url))
	{
		//----- Secondary nav -----
		$btn_menu[] = array('btn_menu'=>'ADD PRODUCTS GROUPS', 'link_menu'=>base_url('product/group/create'), 'icon'=>'icon-plus-2');
		$btn_menu[] = array('btn_menu'=>'MANAGE PRODUCTS GROUPS', 'link_menu'=>base_url('product/manage'));
	}
	else if(!isset($product_detail))
	{
		$btn_menu[] = array('btn_menu'=>'ADD PRODUCTS', 'link_menu'=>base_url('product/view/'.$group_detail->url.'/create'), 'icon'=>'icon-plus-2');
		$btn_menu[] = array('btn_menu'=>'MANAGE PRODUCTS', 'link_menu'=>base_url('product/view/'.$group_detail->url.'/manage'));
	}
	else
	{
		$btn_menu[] = array('btn_menu'=>'ADD IMAGES', 'link_menu'=>base_url('product/view/'.$group_detail->url.'/'.$product_detail->product_id.'/create'), 'icon'=>'icon-plus-2');
		$btn_menu[] = array('btn_menu'=>'MANAGE IMAGES', 'link_menu'=>base_url('product/view/'.$group_detail->url.'/'.$product_detail->product_id.'/images/manage'));
	}

	$data['sec_menu'] = array('btn_menu'=>$btn_menu);

	echo $this->load->view('templates/second_menu', $data);
?>
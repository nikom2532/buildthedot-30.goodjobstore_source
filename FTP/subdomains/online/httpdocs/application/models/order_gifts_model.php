<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order_gifts_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	function get_data($where=array(), $limit=NULL, $offset=NULL)
	{
		return $this->db->get_where('order_gifts', $where, $limit, $offset);
	}

	function set_data($Order_ID=NULL, $gift_type=array())
	{
		if(empty($Order_ID))
		{
			return FALSE;
		}

		$this->db->delete('order_gifts', array('Order_ID'=>$Order_ID));
		foreach($gift_type as $key => $value)
		{
			$insert_arr = array(
				'Order_ID'		=>	$Order_ID,
				'Product_ID'	=>	$key,
				'gift_type'		=>	$value
			);
			$this->db->insert('order_gifts', $insert_arr);
		}

		return TRUE;
	}
}

/* End of file order_gifts_model.php */
/* Location: ./application/models/order_gifts_model.php*/
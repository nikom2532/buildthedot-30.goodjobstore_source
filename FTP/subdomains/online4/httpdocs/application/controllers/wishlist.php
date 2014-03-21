<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Wishlist extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('logged_in'))
		{
			redirect('login');
		}
	}

	function index()
	{
		
	}
	
	function add($product_id=NULL, $color_id=NULL)
	{
		if($product_id===NULL OR $color_id===NULL)
		{
			echo '<script>window.history.back()</script>';
			return;
		}
		
		$check = $this->db->get_where('wish_list', array('Cus_ID'=>$this->session->userdata('customer')->Cus_ID, 'Color_ID'=>$color_id, 'Product_ID'=>$product_id))->row();
		
		if(isset($check->WL_ID))
		{
			$this->db->where('WL_ID', $check->WL_ID);
			$this->db->update('wish_list', array('Qty' => $check->Qty+1 ));	
		}
		else
		{
			$data = array(
				'Cus_ID' => $this->session->userdata('customer')->Cus_ID,
				'Color_ID' => $color_id,
				'Product_ID' => $product_id,
				'Create_Date' => date("Y-m-d"),
				'Qty' => 1
			);
			
			$this->db->insert('wish_list', $data);	
		}
		
		redirect('my/wishlist');
	}
	
	function update()
	{
		if($this->input->post('qty')==0 OR $this->input->post('qty')==NULL OR !is_numeric($this->input->post('qty')))
		{
			redirect('my/wishlist');
		}
		else
		{
			$data = array(
				'Comment' => $this->input->post('comment'),
				'Qty' => $this->input->post('qty')
			);
			
			$this->db->where('WL_ID', $this->input->post('WL_ID'));
			$this->db->update('wish_list', $data);	
		}
		
		redirect('my/wishlist');
	}

	function delete($WL_ID=NULL)
	{
		if($WL_ID===NULL)
		{
			echo '<script>window.history.back()</script>';
			return;
		}
		
		$this->db->delete('wish_list', array('WL_ID' => $WL_ID));
		redirect('my/wishlist');
	}
	

}

/* End of file wishlist.php */
/* Location: ./application/controllers/wishlist.php */
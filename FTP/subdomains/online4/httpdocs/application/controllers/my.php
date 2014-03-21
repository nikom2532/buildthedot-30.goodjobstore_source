<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class My extends MY_Controller
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
		redirect('my/notification');
	}
	
	function notification()
	{
		$Cus_ID = $this->session->userdata('customer')->Cus_ID;
		
		$now = date("Y-m-d");
		$date = date("Y-m-d", strtotime("-30 day", strtotime($now)));
		
		$this->db->select('order_item.Order_ID, orders.Order_ID, order_item.Order_ID as order_item_Order_ID,order_item.Total_Price as order_item_Total_Pricec, order_item.Qty as order_item_Qty, order_item.Create_Date as order_item_Create_Date, order_item.Status as order_item_Status,order_item.Color_ID as order_item_Color_ID, products.Product_ID as products_Product_ID, products.Pro_Name_Th as products_Pro_Name_Th, products.Pro_Name_En as products_Pro_Name_En, products.Description_Th as products_Description_Th, products.Description_En as products_Description_En, images.Path_Small as images_Path_Small, images.Status as images_Status, images.Thumbnail_path as images_Thumbnail_path');
		$this->db->order_by('order_item.Create_Date', 'desc');
		$this->db->order_by('order_item.Item_ID', 'desc');
		$this->db->from('orders');
		$this->db->join('order_item', 'order_item.Order_ID = orders.Order_ID');
		$this->db->where('orders.Cus_ID', $Cus_ID);
		$this->db->where('orders.Order_Status', 1);
		$this->db->where('order_item.Create_Date >', $date);
		
		$this->db->join('products', 'products.Product_ID = order_item.Product_ID');
		$this->db->join('images', 'images.Product_ID = products.Product_ID');
		$this->db->where('images.Level', 1);
		$query = $this->db->get()->result();
		
		$data['results'] = $query;

		$data['notifications'] = $this->_get_restock_notification();

		//var_dump($data['notifications']);

		$data['nav_1'] = array('name'=>'Notification', 'link'=>site_url("my/notification"), 'current'=>TRUE);
		$this->template->view('my/notification', $data);
	}
	
	function _get_restock_notification()
	{
		$Cus_ID = $this->session->userdata('customer')->Cus_ID;
		
		$stock_notifications = $this->db->get_where('stock_notifications', array('Cus_ID'=> $Cus_ID));
		
		foreach ($stock_notifications->result() as $key => $value) 
		{
			$product_id[] = $value->Product_ID;
		}
		
		if(isset($product_id))
		{
			$this->db->select('*');
		$this->db->from('products');
		$this->db->where_in('products.Product_ID', $product_id);
		$this->db->join('images', 'images.Product_ID = products.Product_ID');
		$this->db->join('color', 'color.Color_ID = images.Color_ID');
		$this->db->where('products.Qty !=', 0);
		$this->db->where('images.Level', 1);
		return $this->db->get()->result();
		}
		
		
	}
	
	function info()
	{
		$Cus_ID = $this->session->userdata('customer')->Cus_ID;
		
		$data['nav_1'] = array('name'=>'My Info', 'link'=>site_url("my/info"), 'current'=>TRUE);
		
		//$query = $this->db->get_where('customers', array('Cus_ID'=>$Cus_ID));
		//$_POST = $query->row_array();
		
		$this->db->select('*');
		$this->db->from('customers');
		$this->db->join('shipping', 'shipping.Cus_ID = customers.Cus_ID');
		$this->db->where('customers.Cus_ID', $Cus_ID);
		
		$query = $this->db->get();
		$_POST = $query->row_array();
		
		if(!$_POST)
		{
			$query = $this->db->get_where('customers', array('Cus_ID'=>$Cus_ID));
			$_POST = $query->row_array();
			
		}
		
		//var_dump($_POST);
		
		$this->form_validation->run('customer_shipping');
		//$this->form_validation->run('shipping');
		
		$this->template->view('my/info', $data);
	}
	
	function info_update()
	{
		$data['nav_1'] = array('name'=>'My Info', 'link'=>site_url("my/info"), 'current'=>TRUE);
		
		if ($this->form_validation->run('customer') == FALSE)
		{
			$this->template->view('my/info');
			return FALSE;
		}
		
		if ($this->form_validation->run('shipping') == FALSE)
		{
			$this->template->view('my/info');
			return FALSE;
		}
		
		$Cus_ID = $this->session->userdata('customer')->Cus_ID;
		$this->db->where('Cus_ID !=', $Cus_ID);
		$query = $this->db->get_where('customers', array('Email'=>$this->input->post('Email')))->row();
		if(!empty($query))
		{
			$error[] = "This Email is already exist.";
			$data['error'] = array('data'=>$error, 'color'=>'red');
			$this->template->view('my/info', $data);
			return;
		}
		else
		{
			$data_customer = array(
							'FirstName' => $this->input->post('FirstName'),
							'LastName' => $this->input->post('LastName'),
							'Address' => $this->input->post('Address'),
							'City_ID' => $this->input->post('City_ID'),
							'Postal_Code' => $this->input->post('Postal_Code'),
							'Phone_Number' => $this->input->post('Phone_Number'),
							'Email' => $this->input->post('Email')
						);
			
			$this->db->where('Cus_ID', $Cus_ID);
			$this->db->update('customers', $data_customer);
		}	
		
		$query_shipping = $this->db->get_where('shipping', array('Cus_ID' => $Cus_ID))->row();
		if(!empty($query_shipping))
		{
			$data_shipping = array(
				's_FirstName' => $this->input->post('s_FirstName'),
				's_LastName' => $this->input->post('s_LastName'),
				's_Address' => $this->input->post('s_Address'),
				's_City_ID' => $this->input->post('s_City_ID'),
				's_Postal_Code' => $this->input->post('s_Postal_Code'),
				's_Phone_Number' => $this->input->post('s_Phone_Number')
			);
		
			$this->db->where('Cus_ID', $Cus_ID);
			$this->db->update('shipping', $data_shipping);	
		}
		else
		{
			$data_shipping = array(
				'Cus_ID' => $Cus_ID,
				's_FirstName' => $this->input->post('s_FirstName'),
				's_LastName' => $this->input->post('s_LastName'),
				's_Address' => $this->input->post('s_Address'),
				's_City_ID' => $this->input->post('s_City_ID'),
				's_Postal_Code' => $this->input->post('s_Postal_Code'),
				's_Phone_Number' => $this->input->post('s_Phone_Number')
			);
		
			$this->db->insert('shipping', $data_shipping);	
		}
		redirect('my/info');
	}
	
	function history()
	{
		$data['nav_1'] = array('name'=>'ORDER HISTORY', 'link'=>site_url("my/history"), 'current'=>TRUE);
		
		$Cus_ID = $this->session->userdata('customer')->Cus_ID;
		
		$now = date("Y-m-d");
		$date = date("Y-m-d", strtotime("-30 day", strtotime($now)));
		
		$this->db->select('order_item.Order_ID, orders.Order_ID, order_item.Order_ID as order_item_Order_ID,order_item.Total_Price as order_item_Total_Pricec, order_item.Qty as order_item_Qty, order_item.Create_Date as order_item_Create_Date, order_item.Status as order_item_Status,order_item.Color_ID as order_item_Color_ID, products.Product_ID, products.Pro_Name_Th as products_Pro_Name_Th, products.Pro_Name_En as products_Pro_Name_En, products.Description_Th as products_Description_Th, products.Description_En as products_Description_En, images.Path_Small as images_Path_Small, images.Status as images_Status, images.Thumbnail_path as images_Thumbnail_path');
		$this->db->order_by('order_item.Create_Date', 'desc');
		$this->db->order_by('order_item.Item_ID', 'desc');
		$this->db->from('orders');
		$this->db->join('order_item', 'order_item.Order_ID = orders.Order_ID');
		$this->db->where('orders.Cus_ID', $Cus_ID);
		$this->db->where('orders.Order_Status', 1);
		$this->db->where('order_item.Create_Date <=', $date);
		
		$this->db->join('products', 'products.Product_ID = order_item.Product_ID');
		$this->db->join('images', 'images.Product_ID = products.Product_ID');
		$this->db->where('images.Level', 1);
		$query = $this->db->get()->result();
		
		$data['results'] = $query;
		
		$this->template->view('my/history', $data);
	}
	
	function wishlist()
	{
		$data['nav_1'] = array('name'=>'WISH LIST', 'link'=>site_url("my/wishlist"), 'current'=>TRUE);
		$Cus_ID = $this->session->userdata('customer')->Cus_ID;
		
		$this->db->select('wish_list.WL_ID as wish_list_WL_ID, wish_list.Color_ID, wish_list.Product_ID, wish_list.Create_Date as wish_list_Create_Date, wish_list.Comment as wish_list_Comment, wish_list.Qty as wish_list_Qty, products.Pro_Name_Th as products_Pro_Name_Th, products.Pro_Name_En as products_Pro_Name_En, products.Size as products_Size, products.Price_sale as products_Price_sale, products.Price_Buy as products_Price_Buy, images.Thumbnail_path as images_Thumbnail_path, color.Name_TH as color_Name_TH, color.Name_EN as color_Name_EN');
		$this->db->order_by('wish_list.Create_Date', 'desc');
		$this->db->order_by('wish_list.WL_ID', 'desc');
		$this->db->from('wish_list');
		$this->db->join('products', 'products.Product_ID = wish_list.Product_ID');
		$this->db->where('wish_list.Cus_ID', $Cus_ID);
		$this->db->join('images', 'images.Product_ID = wish_list.Product_ID AND images.Color_ID = wish_list.Color_ID');
		$this->db->join('color', 'color.Color_ID = wish_list.Color_ID');
		$this->db->group_by(array("images.Product_ID", "images.Color_ID")); 
		$data['results'] = $this->db->get()->result();

		//var_dump($result);
		
		$this->template->view('my/wishlist', $data);
	}
	
	function coupon()
	{
		$data['nav_1'] = array('name'=>'coupon', 'link'=>site_url("my/coupon"), 'current'=>TRUE);
		$this->template->view('my/coupon', $data);
	}

	

}

/* End of file my.php */
/* Location: ./application/controllers/my.php */
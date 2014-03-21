<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mail extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		/*$attach = base_url().'public/pdf/P000031807121228.pdf';
		
		$config = Array(
		  'protocol' => 'smtp',
		  'smtp_host' => 'smtpweb.netdesignhost.com',
		  'mailtype' => 'html',
		  'wordwrap' => TRUE
		);
		 
		$this->email->initialize($config);
		  
		$this->email->set_newline("\r\n");
		$this->email->from('infos@phatphong.com');
		$this->email->to('iphatphong@gmail.com');
		$this->email->subject('testss');
		$this->email->message('testssssssssssssssss'.$attach);
		
		//$attach = base_url().'public/pdf/P000031807121228.pdf';
		
		$this->email->attach('public/pdf/P000031807121228.pdf');
		
		$this->email->send();
		echo $this->email->print_debugger();*/
	}
	
	function forget()
	{
		if(isset($_POST['email']))
		{
			$customer = $this->_check_forget_data($_POST['email']);
			if($customer)
			{
				$data['customer'] = $customer;
				$msg = $this->load->view('mail/forget_password', $data, TRUE);
			
				$email_arr = array(
					'from' => 'contact@goodjobstore.com',
					'to' => $customer->Email,
					'subject' => 'GOODJOB Your password.',
					'message' => $msg
				);
				
				send_mail_helper($email_arr);
	

				$data['error_login'] = array('data'=> array("Your password have already send to your e-mail.") , 'color'=>'green');
				$data['nav_1'] = array('name'=>'Login', 'link'=>site_url('login'), 'current'=>TRUE);
				$this->template->view('auth/login', $data);
			}
			else
			{
				$data['error_login'] = array('data'=> array("We Couldn't Find Your Email. Please Try Again.") , 'color'=>'red');
				$data['nav_1'] = array('name'=>'Login', 'link'=>site_url('login'), 'current'=>TRUE);
				$this->template->view('auth/login', $data);
			}
		}
		else
		{
			$data['nav_1'] = array('name'=>'Login', 'link'=>site_url('login'), 'current'=>TRUE);
			$this->template->view('auth/login', $data);
		}
	}
	
	function _check_forget_data($email=NULL)
	{
		return $this->db->get_where('customers', array('Email'=>$email))->row();
	}
	
	function notification()
	{
		$this->db->select('*');
		$this->db->from('stock_notifications');
		$this->db->join('products', 'products.Product_ID = stock_notifications.Product_ID');
		$this->db->where('products.Qty >', 0);
		$this->db->where('stock_notifications.status', 1);
		$query = $this->db->get()->result();
		
		foreach ($query as $key => $value) 
		{
			$data['customer'] = $this->_get_customer($value->Cus_ID);
			$data['product'] = $this->_get_product($value->Product_ID);
			
			$msg = $this->load->view('mail/notification', $data, TRUE);
			
			$email_arr = array(
				'from' => 'contact@goodjobstore.com',
				'to' => $value->email,
				'subject' => 'GOODJOB Product is now available',
				'message' => $msg
			);
			
			send_mail_helper($email_arr);
			
			//$this->db->delete('stock_notifications', array('id'=>$value->id));
			$this->db->where('id', $value->id);
			$this->db->update('stock_notifications', array('status' => 0));
		}
	}
	
	function get_in_touch()
	{
		$data['email'] = $this->input->post('email');
		$data['country'] = $this->input->post('country');
		$data['name'] = $this->input->post('name');
		$data['message'] = $this->input->post('message');
		
		//$this->load->view('mail/get_in_touch', $data);
		$msg = $this->load->view('mail/get_in_touch', $data, TRUE);
		
		$email_arr = array(
			'from' => $this->input->post('email'),
			'to' => 'contact@goodjobstore.com',
			'subject' => 'GOODJOB message form contact',
			'message' => $msg
		);
		
		send_mail_helper($email_arr);
		redirect('guide/about');
	}
	
	function _get_customer($Cus_ID)
	{
		return $this->db->get_where('customers', array('Cus_ID' => $Cus_ID))->row();
	}
	
	function _get_product($Product_ID)
	{
		$this->db->select('*');
		$this->db->from('products');
		$this->db->where_in('products.Product_ID', $Product_ID);
		$this->db->join('images', 'images.Product_ID = products.Product_ID');
		$this->db->join('color', 'color.Color_ID = images.Color_ID');
		$this->db->where('images.Level', 1);
		return $this->db->get()->row();
	}

	/*function send()
	{
		$data['test'] = array(
				'd' => 1,
				'e' => 'd'
		);
		
		$msg = $this->load->view('welcome_message', $data, true);
		
		$config = Array(
		  'protocol' => 'smtp',
		  'smtp_host' => 'ssl://smtp.googlemail.com',
		  'smtp_port' => 465,
		  'smtp_user' => 'iphatphong@gmail.com', // change it to yours
		  'smtp_pass' => '90525302[vpot0hk', // change it to yours
		  'mailtype' => 'html',
		  'wordwrap' => TRUE
		);
		 
		$this->email->initialize($config);
		  
		$this->email->set_newline("\r\n");
		$this->email->from('iphatphong@gmail.com'); // change it to yours
		$this->email->to('dekchyboy@gmail.com'); // change it to yours
		$this->email->subject('Email using Gmail.');
		$this->email->message($msg);
		 
		$this->email->send();
		  
		echo $this->email->print_debugger();
	}*/
	
	function test()
	{
		$data = $this->_order_data();
		var_dump($data);
	}
	
	function pdf()
	{
		$data = $this->_order_data();
		$this->load->view('mail/pdf', $data);
	}
	
	function _order_data()
	{
		$Cus_ID = $this->session->userdata('customer')->Cus_ID;
		$order = $this->_get_order_id();
		$Order_ID = $order->Order_ID;
		
			$data['order'] = $this->db->get_where('orders', array('Order_ID'=>$Order_ID))->row();
			$data['order_items'] = $this->_get_order_item_data($Order_ID);
			$data['shipping'] = $this->db->get_where('shipping', array('Cus_ID'=>$Cus_ID))->row();
			$data['customer'] = $this->db->get_where('customers', array('Cus_ID'=>$Cus_ID))->row();
		
		return $data;
	}
	
	function _get_order_id()
	{
		$Cus_ID = $this->session->userdata('customer')->Cus_ID;
		$carts = $this->_get_cart_data_to_order();
		$order = $this->db->get_where('orders', array('Cus_ID'=>$Cus_ID, 'Order_Status'=>0))->row();
		
		return $order;
	}
	
	function _get_order_item_data($Order_ID=NULL)
	{
		$this->db->select('order_item.Item_ID as order_item_Item_ID, order_item.Color_ID as order_item_Color_ID, order_item.Product_ID as order_item_Product_ID, order_item.Create_Date as order_item_Create_Date, order_item.Qty as order_item_Qty, order_item.Total_Price as order_item_Total_Price, products.Pro_Name_Th as products_Pro_Name_Th, products.Pro_Name_En as products_Pro_Name_En, products.Size as products_Size, products.Price_sale as products_Price_sale, products.Price_Buy as products_Price_Buy,products.Product_Code as products_Product_Code, images.Thumbnail_path as images_Thumbnail_path, color.Name_TH as color_Name_TH, color.Name_EN as color_Name_EN');
		$this->db->order_by('order_item.Product_ID', 'asc');
		$this->db->from('order_item');
		$this->db->join('products', 'products.Product_ID = order_item.Product_ID');
		$this->db->where('order_item.Order_ID', $Order_ID);
		
		$this->db->join('images', 'images.Product_ID = order_item.Product_ID AND images.Color_ID = order_item.Color_ID');
		$this->db->join('color', 'color.Color_ID = order_item.Color_ID');
		$this->db->group_by(array("images.Product_ID", "images.Color_ID")); 
		return $this->db->get()->result();
		
		/*foreach ($this->db->get()->result() as $key => $value) 
		{
			var_dump($value);
			echo '<br><br>';
		}*/
	}
	
	function _get_cart_data_to_order()
	{
		$this->db->select('cart.Cart_ID as cart_Cart_ID, cart.Color_ID as cart_Color_ID, cart.Product_ID as cart_Product_ID, cart.Create_Date as cart_Create_Date, cart.Qty as cart_Qty, products.Pro_Name_Th as products_Pro_Name_Th, products.Pro_Name_En as products_Pro_Name_En, products.Size as products_Size, products.Weight as products_Weight, products.Price_sale as products_Price_sale, products.Price_Buy as products_Price_Buy, images.Thumbnail_path as images_Thumbnail_path, color.Name_TH as color_Name_TH, color.Name_EN as color_Name_EN');
		$this->db->order_by('cart.Create_Date', 'desc');
		$this->db->order_by('cart.Cart_ID', 'desc');
		$this->db->from('cart');
		$this->db->join('products', 'products.Product_ID = cart.Product_ID');
		
		$Cus_ID = $this->session->userdata('customer')->Cus_ID;
		$this->db->where('cart.Cus_ID', $Cus_ID);
		
		$this->db->join('images', 'images.Product_ID = cart.Product_ID AND images.Color_ID = cart.Color_ID');
		$this->db->join('color', 'color.Color_ID = cart.Color_ID');
		$this->db->group_by(array("images.Product_ID", "images.Color_ID")); 
		return $this->db->get()->result();
	}
	
	function shipping_mail()
	{
		$this->db->select('*');
		$this->db->from('orders');
		$this->db->join('customers', 'customers.Cus_ID = orders.Cus_ID');
		$this->db->where('orders.status', 3);
		$this->db->where('orders.shipped_mail', NULL);
		$query = $this->db->get()->result();
		
		//var_dump($query);
		
		foreach ($query as $key => $value) 
		{
			$data['customer'] = $this->_get_customer($value->Cus_ID);
			$data['order'] = $value;
			
			//var_dump($data['customer']);
			
			//var_dump($value);
			//echo '<br><br>';
			
			$msg = $this->load->view('mail/shipping', $data, TRUE);
			
			$email_arr = array(
				'from' => 'contact@goodjobstore.com',
				'to' => $value->Email,
				'subject' => 'GOODJOB Order is now shipped',
				'message' => $msg
			);
			
			send_mail_helper($email_arr);
			
			$this->db->where('Order_ID', $value->Order_ID);
			$this->db->update('orders', array('shipped_mail' => 1));
		}
	}
	
	function barcode()
	{
		$this->load->view('mail/barcode');
	}

}


/* End of file mail.php */
/* Location: ./application/controllers/mail.php */
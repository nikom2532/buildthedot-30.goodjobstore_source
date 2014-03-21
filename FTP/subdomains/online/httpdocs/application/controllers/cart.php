<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cart extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$data['nav_1'] = array('name'=>'SHOPPING CART', 'link'=>site_url("cart"), 'current'=>TRUE);
		
		
		$this->db->select('cart.Cart_ID as cart_Cart_ID, cart.Color_ID, cart.Product_ID, cart.Create_Date as cart_Create_Date, cart.Qty as cart_Qty, products.Pro_Name_Th as products_Pro_Name_Th, products.Pro_Name_En as products_Pro_Name_En, products.Size as products_Size, products.Price_sale as products_Price_sale, products.Price_Buy as products_Price_Buy, images.Thumbnail_path as images_Thumbnail_path, color.Name_TH as color_Name_TH, color.Name_EN as color_Name_EN');
		$this->db->order_by('cart.Create_Date', 'desc');
		$this->db->order_by('cart.Cart_ID', 'desc');
		$this->db->from('cart');
		$this->db->join('products', 'products.Product_ID = cart.Product_ID');
		
		if($this->session->userdata('logged_in'))
		{
			$Cus_ID = $this->session->userdata('customer')->Cus_ID;
			$this->db->where('cart.Cus_ID', $Cus_ID);
		}
		else
		{
			$Session_ID = $this->session->userdata('session_id');
			$this->db->where('cart.Session_ID', $Session_ID);
			//echo $Session_ID;
		}
		
		$this->db->join('images', 'images.Product_ID = cart.Product_ID AND images.Color_ID = cart.Color_ID');
		$this->db->join('color', 'color.Color_ID = cart.Color_ID');
		//$this->db->where('images.Level', )
		$this->db->group_by(array("images.Product_ID", "images.Color_ID")); 
	
		$data['results'] = $this->db->get()->result();

		//var_dump($result);
		
		$this->template->view('cart/index', $data);
	}
	
	function add($product_id=NULL, $color_id=NULL)
	{
		if($product_id===NULL OR $color_id===NULL)
		{
			echo '<script>window.history.back()</script>';
			return;
		}
		
		if($this->session->userdata('logged_in'))
		{
		
			$check = $this->db->get_where('cart', array('Cus_ID'=>$this->session->userdata('customer')->Cus_ID, 'Color_ID'=>$color_id, 'Product_ID'=>$product_id))->row();
			
			if(isset($check->Cart_ID))
			{
				$this->db->where('Cart_ID', $check->Cart_ID);
				$this->db->update('cart', array('Qty' => $check->Qty+1 ));	
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
				
				$this->db->insert('cart', $data);	
			}
		}
		else
		{
			$check = $this->db->get_where('cart', array('Session_ID'=>$this->session->userdata('session_id'), 'Color_ID'=>$color_id, 'Product_ID'=>$product_id))->row();
			
			if(isset($check->Cart_ID))
			{
				$this->db->where('Cart_ID', $check->Cart_ID);
				$this->db->update('cart', array('Qty' => $check->Qty+1 ));	
			}
			else
			{
				$data = array(
					'Session_ID' => $this->session->userdata('session_id'),
					'Color_ID' => $color_id,
					'Product_ID' => $product_id,
					'Create_Date' => date("Y-m-d"),
					'Qty' => 1
				);
				
				$this->db->insert('cart', $data);
			}
		}
		
		
		redirect($this->session->userdata('prev_url'));
	}
	
	function delete($Cart_ID=NULL)
	{
		if($Cart_ID===NULL)
		{
			echo '<script>window.history.back()</script>';
			return;
		}
		
		$this->db->delete('cart', array('Cart_ID' => $Cart_ID));
		redirect('cart');
	}
	
	function up($Cart_ID=NULL)
	{
		if($Cart_ID===NULL)
		{
			echo '<script>window.history.back()</script>';
			return;
		}
		
		$cart = $this->db->get_where('cart', array('Cart_ID'=>$Cart_ID))->row();
		if(isset($cart->Qty))
		{
			$new_qty = $cart->Qty + 1;
			$this->db->where('Cart_ID', $Cart_ID);
			$this->db->update('cart', array('Qty' => $new_qty));
		}
		redirect('cart');
	}
	
	function down($Cart_ID=NULL)
	{
		if($Cart_ID===NULL)
		{
			echo '<script>window.history.back()</script>';
			return;
		}
		
		$cart = $this->db->get_where('cart', array('Cart_ID'=>$Cart_ID))->row();
		if($cart->Qty!=1)
		{
			$new_qty = $cart->Qty - 1;
			$this->db->where('Cart_ID', $Cart_ID);
			$this->db->update('cart', array('Qty' => $new_qty));
		}
		redirect('cart');
	}
	
	function all_wishlist()
	{
		$Cus_ID = $this->session->userdata('customer')->Cus_ID;
		
		$wish_lists = $this->db->get_where('wish_list', array('Cus_ID'=>$Cus_ID))->result();
		
		foreach ($wish_lists as $wish_list) 
		{
			$WL_ID = $wish_list->WL_ID;
			if(isset($wish_list->WL_ID))
			{
				$check = $this->db->get_where('cart', array('Cus_ID'=>$this->session->userdata('customer')->Cus_ID, 'Color_ID'=>$wish_list->Color_ID, 'Product_ID'=>$wish_list->Product_ID))->row();
				
				if(isset($check->Cart_ID))
				{
					$this->db->where('Cart_ID', $check->Cart_ID);
					$this->db->update('cart', array('Qty' => $check->Qty + $wish_list->Qty ));	
					
					$this->db->delete('wish_list', array('WL_ID'=>$WL_ID));
				}
				else
				{
					$data = array(
						'Cus_ID' => $this->session->userdata('customer')->Cus_ID,
						'Color_ID' => $wish_list->Color_ID,
						'Product_ID' => $wish_list->Product_ID,
						'Create_Date' => date("Y-m-d"),
						'Qty' => $wish_list->Qty
					);
					
					$this->db->insert('cart', $data);	
					
					$this->db->delete('wish_list', array('WL_ID'=>$WL_ID));
				}
			}
		}
		
		redirect('cart');
	}
	
	function wishlist($WL_ID=NULL)
	{
		$wish_list = $this->db->get_where('wish_list', array('WL_ID'=>$WL_ID))->row();
		if(isset($wish_list->WL_ID))
		{
			$check = $this->db->get_where('cart', array('Cus_ID'=>$this->session->userdata('customer')->Cus_ID, 'Color_ID'=>$wish_list->Color_ID, 'Product_ID'=>$wish_list->Product_ID))->row();
			
			if(isset($check->Cart_ID))
			{
				$this->db->where('Cart_ID', $check->Cart_ID);
				$this->db->update('cart', array('Qty' => $check->Qty + $wish_list->Qty ));	
				
				$this->db->delete('wish_list', array('WL_ID'=>$WL_ID));
			}
			else
			{
				$data = array(
					'Cus_ID' => $this->session->userdata('customer')->Cus_ID,
					'Color_ID' => $wish_list->Color_ID,
					'Product_ID' => $wish_list->Product_ID,
					'Create_Date' => date("Y-m-d"),
					'Qty' => $wish_list->Qty
				);
				
				$this->db->insert('cart', $data);	
				
				$this->db->delete('wish_list', array('WL_ID'=>$WL_ID));
			}
		}
		redirect('cart');
	}
	
	function move_wishlist()
	{
		if($this->session->userdata('logged_in'))
		{
			if($this->input->post('move_wishlist'))
			{
				foreach ($this->input->post('move_wishlist') as $key => $value) 
				{
					//echo "{$value} <br/>";
					$this->_move_to_wishlist($value);
				}	
			}
		}
		
		redirect('cart');
	}
	
	function _move_to_wishlist($Cart_ID=NULL)
	{
		$cart = $this->db->get_where('cart', array('Cart_ID'=>$Cart_ID))->row();
		if(isset($cart->Cart_ID))
		{
			$check = $this->db->get_where('wish_list', array('Cus_ID'=>$this->session->userdata('customer')->Cus_ID, 'Color_ID'=>$cart->Color_ID, 'Product_ID'=>$cart->Product_ID))->row();
			
			if(isset($check->WL_ID))
			{
				$this->db->where('WL_ID', $check->WL_ID);
				$this->db->update('wish_list', array('Qty' => $check->Qty + $cart->Qty ));	
				
				$this->db->delete('cart', array('Cart_ID'=>$Cart_ID));
			}
			else
			{
				$data = array(
					'Cus_ID' => $this->session->userdata('customer')->Cus_ID,
					'Color_ID' => $cart->Color_ID,
					'Product_ID' => $cart->Product_ID,
					'Create_Date' => date("Y-m-d"),
					'Qty' => $cart->Qty
				);
				
				$this->db->insert('wish_list', $data);	
				
				$this->db->delete('cart', array('Cart_ID'=>$Cart_ID));
			}
		}
		
		return;
	}
	
	function add_coupon()
	{
		$Cus_ID = $this->session->userdata('customer')->Cus_ID;
		$couponcode = $this->input->post('couponcode');
		$now = date("Y-m-d");
		
		if(!$this->input->post('couponcode') OR $couponcode==NULL)
		{
			echo '<script>window.history.back()</script>';
			return;
		}
		
		$coupon = $this->db->get_where('coupon', array('Coupon_ID' => $couponcode))->row();
		if(isset($coupon->Coupon_ID))
		{
			$use_coupon = $this->db->get_where('coupon_customers', array('Coupon_ID' => $couponcode, 'status' => '0'))->row();
			if(isset($use_coupon->Coupon_ID))
			{
				$this->session->set_flashdata('message',array('message' => 'Coupon code is used.','type'=>'error'));
				redirect('cart');
			}

			//echo "C000001";
			if($coupon->Start_Date <= $now && $coupon->Expired_Date >= $now && $coupon->Discount_Status != 0)
			{
				$this->db->select('coupon.Coupon_ID as coupon_Coupon_ID, coupon.Discount_PC as coupon_Discount_PC, coupon.Discount_Cash as coupon_Discount_Cash, coupon.Start_Date as coupon_Start_Date, coupon.Expired_Date as coupon_Expired_Date, coupon.Db_Min as coupon_Db_Min, coupon.Db_Max as coupon_Db_Max, coupon.Discount_Status as coupon_Discount_Status, coupon_customers.id as coupon_customers_id, coupon_customers.Cus_ID as coupon_customers_Cus_ID, coupon_customers.Coupon_ID as coupon_customers_Coupon_ID, coupon_customers.created_at as coupon_customers_created_at, coupon_customers.status as coupon_customers_status');
				$this->db->from('coupon_customers');
				$this->db->join('coupon', 'coupon.Coupon_ID = coupon_customers.Coupon_ID');
				$this->db->where('coupon_customers.Cus_ID', $Cus_ID);
				$this->db->where('coupon_customers.status', 1);
				$this->db->where('coupon.Discount_Status !=', 0);
				$this->db->where('coupon.Start_Date <=', $now);
				$this->db->where('coupon.Expired_Date >=', $now);
				
				$coupon_customers = $this->db->get()->row();
				
				//var_dump($coupon_customers);
				
				if(isset($coupon_customers->coupon_customers_id))
				{
					$this->session->set_flashdata('message',array('message' => 'You can not use coupon more than one time.','type'=>'error'));
					redirect('cart');
				}
				else
				{
					$data = array(
						'Cus_ID' => $Cus_ID,
						'Coupon_ID' => $couponcode,
						'created_at' => $now
					);
					
					$this->db->insert('coupon_customers', $data);
					
					//$this->session->set_flashdata('message',array('message' => 'Error','type'=>'success'));
					redirect('cart');
				}
				
			}
			else
			{
				$this->session->set_flashdata('message',array('message' => 'Coupon code is not enabled or expire.','type'=>'error'));
				redirect('cart');
			}	
		}
		else
		{
			$this->session->set_flashdata('message',array('message' => 'Coupon code is incorrect.','type'=>'error'));
			redirect('cart');
		}
	}
	
	
	function stock_notification()
	{
		echo $email = $this->input->post('email');
		echo $Product_ID = $this->input->post('Product_ID');
		$now = date("Y-m-d");
		
		if(empty($email))
		{
			redirect("item/{$Product_ID}");
		}
		
		if($this->session->userdata('logged_in'))
		{
			$data = array(
				'Cus_ID' => $this->session->userdata('customer')->Cus_ID,
				'Product_ID' => $Product_ID,
				'email' => $email,
				'created_at' => $now
			);
			
			$this->db->insert('stock_notifications', $data);
		}
		else
		{
			$data = array(
				'Product_ID' => $Product_ID,
				'email' => $email,
				'created_at' => $now
			);
			
			$this->db->insert('stock_notifications', $data);
		}
		
		//redirect("item/{$Product_ID}");

		redirect($this->session->userdata('prev_url'));
	}
	
	
	

}

/* End of file cart.php */
/* Location: ./application/controllers/cart.php */
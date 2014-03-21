<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Auth extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
	}

	function index()
	{

	}

	function login()
	{
		if($this->session->userdata('logged_in'))
		{
			redirect('my');
		}

		$data = array();
		$data['nav_1'] = array('name'=>'Login', 'link'=>site_url('login'), 'current'=>TRUE);
		$this->template->view('auth/login', $data);
	}

	function verify()
	{
		$query = $this->db->get_where('customers', array('Email'=>$this->input->post('email') , 'Password'=>$this->input->post('password')))->row();
		if(empty($query) OR empty($_POST['email']) OR empty($_POST['password']))
		{
			$error[] = "The email or password you entered is incorrect.";
			$data['error_login'] = array('data'=>$error, 'color'=>'red');
			$data['nav_1'] = array('name'=>'Login', 'link'=>site_url('login'), 'current'=>TRUE);
			$this->template->view('auth/login', $data);
			return;
		}
		else
		{
			$this->session->set_userdata('customer', $query);
			$this->session->set_userdata('logged_in', TRUE);
			$this->_update_cart_from_session();
			$last_page = $this->session->userdata('last_page');
			redirect($last_page);
		}
	}

	function forget()
	{
		//$data['nav_1'] = array('name'=>'Forget Password', 'link'=>site_url('forget'), 'current'=>TRUE);
		$this->load->view('auth/forget');
	}

	function _update_cart_from_session()
	{
		$customer_id = $this->session->userdata('customer')->Cus_ID;
		//echo $this->session->userdata('session_id');

		$by_session = $this->db->get_where('cart', array('Session_ID'=>$this->session->userdata('session_id')))->result();
		foreach ($by_session as $key => $value)
		{
			//var_dump($value);
			//echo "<br/><br/>";
			$by_id = $this->db->get_where('cart', array('Cus_ID'=>$customer_id, 'Color_ID'=>$value->Color_ID, 'Product_ID'=>$value->Product_ID))->row();

			if(isset($by_id->Cart_ID))
			{
				$this->db->where('Cart_ID', $by_id->Cart_ID);
				$this->db->update('cart', array('Qty' => $by_id->Qty + $value->Qty ));

				$this->db->delete('cart', array('Cart_ID'=>$value->Cart_ID));
			}
			else
			{
				$this->db->where('Cart_ID', $value->Cart_ID);
				$this->db->update('cart', array('Cus_ID' => $customer_id, 'Session_ID'=>NULL ));
			}
		}
		return;
	}

	function register()
	{
		if($this->session->userdata('logged_in'))
		{
			redirect('my');
		}
		$data['nav_1'] = array('name'=>'Register', 'link'=>site_url('login'), 'current'=>TRUE);
		$this->template->view('auth/login', $data);
	}

	function registration()
	{
		$data['nav_1'] = array('name'=>'Register', 'link'=>site_url('login'), 'current'=>TRUE);
		if(!$this->input->post('Email'))
		{
			$error[] = "Email is missing!";
		}

		if(!$this->input->post('Password'))
		{
			$error[] = "Password is missing!";
		}

		if(strlen($this->input->post('Password')) < 4)
		{
			$error[] = "Password is to short, 4 characters min!";
		}

		if(!$this->input->post('Password2'))
		{
			$error[] = "Please repeat your password!";
		}

		if($this->input->post('Password') != $this->input->post('Password2'))
		{
			$error[] = "Your passwords do not match!";
		}

		if(isset($error))
		{
			$data['error'] = array('data'=>$error, 'color'=>'red');
			$this->template->view('auth/login', $data);
		}
		else
		{
			$query = $this->db->get_where('customers', array('Email'=>$this->input->post('Email')))->row();
			if(!empty($query))
			{
				$error[] = "This Email is already exist.";
				$data['error'] = array('data'=>$error, 'color'=>'red');
				$this->template->view('auth/login', $data);
			}
			else
			{
				$this->db->order_by('Cus_ID', 'desc');
				$query = $this->db->get('customers')->row()->Cus_ID;

				$id = str_replace('P','',$query);
				//$Cus_ID = 'P'.sprintf("%05d",$id+1);
				$Cus_ID = sprintf("%05d",$id+1);

				$customer = array(
					'Cus_ID' => $Cus_ID,
					'Email' => $this->input->post('Email'),
					'Password' => $this->input->post('Password'),
					'newsletter' => $this->input->post('newsletter'),
					'created_at' => date("Y-m-d H:i:s")
				);
				$this->db->insert('customers', $customer);

				$this->_send_mail_register($customer);

				$email = $this->input->post('Email');
				$password = $this->input->post('Password');
				$this->_regis_verify($email, $password);

				/*$data['error'] = array('data'=> array('Register was succesful.') , 'color'=>'green');
				$this->template->view('auth/login', $data);*/
			}
		}

	}

	function _regis_verify($email=NULL, $password=NULL)
	{
		$query = $this->db->get_where('customers', array('Email'=>$email , 'Password'=>$password))->row();
		if(empty($query))
		{
			$error[] = "The email or password you entered is incorrect.";
			$data['error_login'] = array('data'=>$error, 'color'=>'red');
			$data['nav_1'] = array('name'=>'Login', 'link'=>site_url('login'), 'current'=>TRUE);
			$this->template->view('auth/login', $data);
			return;
		}
		else
		{
			$this->session->set_userdata('customer', $query);
			$this->session->set_userdata('logged_in', TRUE);
			$this->_update_cart_from_session();
			$last_page = $this->session->userdata('last_page');
			redirect($last_page);
		}
	}

	function _send_mail_register($customer)
	{
		$data['customer'] = $customer;
		$msg = $this->load->view('mail/register', $data, TRUE);

		$email_arr = array(
			'from' => 'contact@goodjobstore.com',
			'to' => $customer['Email'],
			'subject' => 'GOODJOB Account is now available',
			'message' => $msg
		);

		send_mail_helper($email_arr);
	}

	function logout()
	{
		$this->session->sess_destroy();
		redirect();
	}

	function mailmail()
	{
		//$msg = $this->load->view('welcome_message', $data, true);

		$email_arr = array(
			'from' => 'iphatphong@gmail.com',
			'to' => 'dekchyboy@gmail.com',
			'subject' => 'Email using Gmail.',
			'message' => 'body'
		);

		send_mail_helper($email_arr);
	}

}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */
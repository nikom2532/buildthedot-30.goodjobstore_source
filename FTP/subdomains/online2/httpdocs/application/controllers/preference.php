<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Preference extends MY_Controller 
{
	function __construct()
	{
		
		parent::__construct();
		//$this->load->library('form_validation');
		if(!$this->session->userdata('logged_in'))
		{
			redirect('login');
		}
	}

	public function index()
	{	
		$this->template->view('preference/index');
	}

	//-------------------------------------------------
	//-------------- Color ----------------------------
	//-------------------------------------------------
	
	public function color()
	{
		$this->template->view('preference/color');
	}
	
	public function create_color_update()
	{
		$this->form_validation->set_message('required', '%s is missing.');
		if($this->form_validation->run('create_color') == FALSE)
		{
			$this->load->library('upload');
			if(!$this->upload->do_upload())
			{
				$data['ermsg'] = "No Img.";
			}
			$this->template->view('preference/color', $data);
			return ;
		}
		//---- image ----
		$img_path = './public/images/color/';
		$config['upload_path'] = $img_path;
		$config['allowed_types'] = '*';
		$config['max_size'] = '5120';
		$this->load->library('upload', $config);
		if($this->upload->do_upload())
		{
			$img_detail = $this->upload->data();
			$data_color = array(
								'name' => $this->input->post('name'),
								'public' => $this->input->post('public'),
								'rank' => get_last_rank_color(),
								'path' => 'public/images/color/'.$img_detail['file_name']
							);
		}
		else
		{
			$data['ermsg'] = "No Img.";
			$this->template->view('preference/color', $data);
			return ;
		}
		$this->db->insert('color', $data_color);
		$this->session->set_flashdata('message',array('message' => 'Create Successful'));
		redirect('preference/color');
	}
	
	public function edit_color($name)
	 {
		$name = str_replace('%20', ' ', $name);
		$_POST = get_select_color_array($name);

		$this->form_validation->run('edit_color');

		$this->template->view('preference/edit_color');
	 }
	public function edit_color_update()
	 {
		$this->form_validation->run('edit_color');
		if(!$this->input->post('name'))
		{	
			$data['ermsg'] = "Name is missing.";
			$this->template->view('preference/edit_color', $data);
			return ;
		}
		/*if(check_edit_name_color($this->input->post('color_id'), $this->input->post('name')))
		{
			$data['ermsg'] = "Name is used.";
			$this->template->view('preference/edit_color', $data);
			return ;
		}*/

		$data_color = array(
							'name' => $this->input->post('name'),
							'public' => $this->input->post('public')
						);
		
		$img_path = './public/images/color/';
		$config['upload_path'] = $img_path;
		$config['allowed_types'] = '*';
		$config['max_size'] = '5120';
		$this->load->library('upload', $config);
		$log_img = get_select_color($this->input->post('color_id'))->path;
		if($this->upload->do_upload())
		{
			$img_detail = $this->upload->data();
			$data_color += array('path' => 'public/images/color/'.$img_detail['file_name']);
			@unlink($log_img);
		}

		$this->db->where('color_id', $this->input->post('color_id'));
		$this->db->update('color', $data_color);
		$this->session->set_flashdata('message',array('message' => 'Edit Successful'));
		redirect('preference/color');
	 }
	 
	public function delete_color($color_id)
	{
		$this->db->where('color_id', $color_id);
		$this->db->delete('color');
		$this->session->set_flashdata('message',array('message' => 'Delete Successful'));
		redirect('preference/color');
	}
	 
	//-------------------------------------------------
	//-------------- Property -------------------------
	//-------------------------------------------------
	
	public function property()
	{	
		$this->template->view('preference/property');
	}
	
	public function create_property_update()
	{	
		$this->form_validation->set_message('required', '%s is missing.');
		if($this->form_validation->run('create_property') == FALSE)
		{	
			$this->load->library('upload');
			if(!$this->upload->do_upload())
			{
				$data['ermsg'] = "No img.";
			}
			$this->template->view('preference/property' , $data);
			return ;
		}
		
		//---- image ----
		$img_path = './public/images/property/';
		$config['upload_path'] = $img_path;
		$config['allowed_types'] = '*';
		$config['max_size'] = '5120';
		$this->load->library('upload', $config);
		if($this->upload->do_upload())
		{
			$img_detail = $this->upload->data();
			$data_property = array(
								'name' => $this->input->post('name'),
								'public' => $this->input->post('public'),
								'rank' => get_last_rank_property(),
								'path' => 'public/images/property/'.$img_detail['file_name']
							);
		}
		else
		{
			echo "No Img.";
			exit;
		}
		$this->db->insert('property', $data_property);
		$this->session->set_flashdata('message',array('message' => 'Create Successful'));
		redirect('preference/property');
	}
	
	public function edit_property($name)
	{
		$name = str_replace('%20', ' ', $name);
		$_POST = get_select_property_array($name);

		$this->form_validation->run('edit_property');

		
		$this->template->view('preference/edit_property');
	}
	
	public function edit_property_update()
	{	
		$this->form_validation->run('edit_property');
		if(!$this->input->post('name'))
		{	
			$data['ermsg'] = "Name is missing.";
			$this->template->view('preference/edit_property', $data);
			return ;
		}
		/*if(check_edit_name_property($this->input->post('prop_id'), $this->input->post('name')))
		{
			$data['ermsg'] = "Name is used.";
			$this->template->view('preference/edit_property', $data);
			return ;
		}*/

		$data_property = array(
							'name' => $this->input->post('name'),
							'public' => $this->input->post('public')
						);
		
		$img_path = './public/images/property/';
		$config['upload_path'] = $img_path;
		$config['allowed_types'] = '*';
		$config['max_size'] = '5120';
		$this->load->library('upload', $config);
		$log_img = get_select_property($this->input->post('prop_id'))->path;
		if($this->upload->do_upload())
		{
			$img_detail = $this->upload->data();
			$data_property += array('path' => 'public/images/property/'.$img_detail['file_name']);
			@unlink($log_img);
		}

		$this->db->where('prop_id', $this->input->post('prop_id'));
		$this->db->update('property', $data_property);
		$this->session->set_flashdata('message',array('message' => 'Edit Successful'));
		redirect('preference/property');
	 }
	
	public function delete_property($prop_id)
	{
		$this->db->where('prop_id', $prop_id);
		$this->db->delete('property');
		$this->session->set_flashdata('message',array('message' => 'Delete Successful'));
		redirect('preference/property');
	}
	
	//-------------------------------------------------
	//-------------- Attribute ------------------------
	//-------------------------------------------------
	public function attribute()
	{
		$this->template->view('preference/attribute');
	}
	
	public function create_attribute_update()
	{
		$this->form_validation->set_message('required', '%s is missing.');
		if($this->form_validation->run('create_attribute') == FALSE)
		{
			$this->template->view('preference/attribute');
			return ;
		}
		

		//--- insert new attribute ---
		$data_attribute = array(
							'name' => $this->input->post('name'),
							'public' => $this->input->post('public')
						);
		$this->db->insert('attribute', $data_attribute);
		$this->session->set_flashdata('message',array('message' => 'Create Successful'));
		redirect('preference/attribute');
	}
	
	public function edit_attribute($name)
	{
		$name = str_replace('%20', ' ', $name);
		$_POST = get_select_attribute_array($name);

		$this->form_validation->run('edit_attribute');

		$this->template->view('preference/edit_attribute');
	}
	
	public function edit_attribute_update()
	{
		$this->form_validation->set_message('required', '%s is missing.');
		if($this->form_validation->run('edit_attribute') == FALSE )
		{
			$this->template->view('preference/edit_attribute');
			return ;
		}
		
		$data_attribute = array(
							'name' => $this->input->post('name'),
							'public' => $this->input->post('public')
						);

		$this->db->where('attribute_id', $this->input->post('attribute_id'));
		$this->db->update('attribute', $data_attribute);
		$this->session->set_flashdata('message',array('message' => 'Edit Successful'));
		redirect('preference/attribute');
	}
	
	public function delete_attribute($attribute_id)
	{
			$this->db->where('attribute_id', $attribute_id);
			$this->db->delete('attribute');
			$this->session->set_flashdata('message',array('message' => 'Delete Successful'));
			redirect('preference/attribute');
	}
	
	//-------------------------------------------------
	//-------------- Keyword -------------------------
	//-------------------------------------------------
	
	public function keyword()
	{
		$this->template->view('preference/keyword');
	}
	
	public function create_keyword_update()
	{	
		$this->form_validation->set_message('required' , 'The %s is missing.');
		if($this->form_validation->run('create_keyword') == FALSE )
		{
			$this->template->view('preference/keyword');
			return ;
		}
		
		//--- insert new keyword ---
		$data_keyword = array(
							'name' => $this->input->post('name')
						);
		$this->db->insert('keyword', $data_keyword);
		$this->session->set_flashdata('message',array('message' => 'Create Successful'));
		redirect('preference/keyword');
	}
	
	public function edit_keyword($name)
	{
		$_POST = get_select_keyword_array($name);
		$this->form_validation->run('edit_keyword');

		$this->template->view('preference/edit_keyword');	
	}
	
	public function edit_keyword_update()
	{
		$this->form_validation->set_message('required' , 'The %s is missing.');
		if($this->form_validation->run('edit_keyword') == FALSE )
		{
			$this->template->view('preference/edit_keyword');
			return ;
		}
		
		$data_keyword = array(
							'name' => $this->input->post('name')
						);

		$this->db->where('keyword_id', $this->input->post('keyword_id'));
		$this->db->update('keyword', $data_keyword);
		$this->session->set_flashdata('message',array('message' => 'Edit Successful'));
		redirect('preference/keyword');
	}
	
	public function delete_keyword($keyword_id)
	{

			$this->db->where('keyword_id', $keyword_id);
			$this->db->delete('keyword');
			$this->session->set_flashdata('message',array('message' => 'Delete Successful'));
			redirect('preference/keyword');
	}
	
	//-------------------------------------------------
	//-------------- Keyword Group---------------------
	//-------------------------------------------------
	
	public function keyword_group()
	{
		$this->template->view('preference/keyword_group');
	}
	
	public function create_keyword_group_update()
	{
		$this->form_validation->set_message('required' , 'The %s is missing.');
		if($this->form_validation->run('create_keyword_group') == FALSE)
		{
			$this->template->view('preference/keyword_group');
			return ;
		}
		

		//--- insert new keyword group ---
		$data_keygroup = array(
							'name' => $this->input->post('name')
						);
		$this->db->insert('keygroup', $data_keygroup);
		$this->session->set_flashdata('message',array('message' => 'Create Successful'));
		redirect('preference/keyword_group');
	}
	
	public function edit_keyword_group($name)
	{
		$_POST = get_select_keyword_group_array($name);
		$this->form_validation->run('edit_keyword_group');
		$this->template->view('preference/edit_keyword_group');
	}
	
	public function edit_keyword_group_update()
	{
		$this->form_validation->set_message('required' , 'The %s is missing.');
		if($this->form_validation->run('edit_keyword_group') == FALSE)
		{
			$this->template->view('preference/edit_keyword_group');
			return ;
		}

		$data_keygroup = array(
							'name' => $this->input->post('name')
						);

		$this->db->where('keygroup_id', $this->input->post('keygroup_id'));
		$this->db->update('keygroup', $data_keygroup);
		$this->session->set_flashdata('message',array('message' => 'Edit Successful'));

		redirect('preference/keyword_group');
	}
	public function delete_keyword_group($keygroup_id)
	{
		
			$this->db->where('keygroup_id', $keygroup_id);
			$this->db->delete('keygroup');
			$this->session->set_flashdata('message',array('message' => 'Delete Successful'));
			redirect('preference/keyword_group');
	}

	//---- check validate ----//
	
	public function check_name_color($name)
	{
		$ci =& get_instance();

		$query = $ci->db->get_where('color', array('name'=>$name))->row();
		if(!empty($query))
		{
			$this->form_validation->set_message('check_name_color', 'The %s is already used');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	public function check_edit_name_color()
	{
		$color_id = $this->input->post('color_id');
		$name = $this->input->post('name');
		$ci =& get_instance();

		$ci->db->where('color_id !=', $color_id);
		$query = $ci->db->get_where('color', array('name'=>$name))->row();
		if(!empty($query))
		{
			$this->form_validation->set_message('check_edit_name_color', 'The %s is already used');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	public function check_name_property($name)
	{
		$ci =& get_instance();

		$query = $ci->db->get_where('property', array('name'=>$name))->row();
		if(!empty($query))
		{
			$this->form_validation->set_message('check_name_property', 'The %s is already used');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	public function check_edit_name_property()
	{
		$prop_id = $this->input->post('prop_id');
		$name = $this->input->post('name');
		$ci =& get_instance();

		$ci->db->where('prop_id !=', $prop_id);
		$query = $ci->db->get_where('property', array('name'=>$name))->row();
		if(!empty($query))
		{
			$this->form_validation->set_message('check_edit_name_property', 'The %s is already used');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	public function check_name_attribute($name)
	{
		$ci =& get_instance();

		$query = $ci->db->get_where('attribute', array('name'=>$name))->row();
		if(!empty($query))
		{
			$this->form_validation->set_message('check_name_attribute', 'The %s is already used');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	public function check_edit_name_attribute()
	{
		$attribute_id = $this->input->post('attribute_id');
		$name = $this->input->post('name');
		$ci =& get_instance();

		$ci->db->where('attribute_id !=', $attribute_id);
		$query = $ci->db->get_where('attribute', array('name'=>$name))->row();
		if(!empty($query))
		{
			$this->form_validation->set_message('check_edit_name_attribute', 'The %s is already used');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	public function check_name_keyword($name)
	{
		$ci =& get_instance();

		$query = $ci->db->get_where('keyword', array('name'=>$name))->row();
		if(!empty($query))
		{
			$this->form_validation->set_message('check_name_keyword', 'The %s is already used');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	public function check_edit_name_keyword()
	{
		$keyword_id = $this->input->post('keyword_id');
		$name = $this->input->post('name');
		$ci =& get_instance();

		$ci->db->where('keyword_id !=', $keyword_id);
		$query = $ci->db->get_where('keyword', array('name'=>$name))->row();
		if(!empty($query))
		{
			$this->form_validation->set_message('check_edit_name_keyword', 'The %s is already used');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	public function check_name_keyword_group($name)
	{
		$ci =& get_instance();

		$query = $ci->db->get_where('keygroup', array('name'=>$name))->row();
		if(!empty($query))
		{
			
			$this->form_validation->set_message('check_name_keyword_group', 'The %s is already used');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	public function check_edit_name_keyword_group()
	{
		$keygroup_id = $this->input->post('keygroup_id');
		$name = $this->input->post('name');
		$ci =& get_instance();

		$ci->db->where('keygroup_id !=', $keygroup_id);
		$query = $ci->db->get_where('keygroup', array('name'=>$name))->row();
		if(!empty($query))
		{
			
			$this->form_validation->set_message('check_edit_name_keyword_group', 'The %s is already used');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	//---- check validate ----//
}
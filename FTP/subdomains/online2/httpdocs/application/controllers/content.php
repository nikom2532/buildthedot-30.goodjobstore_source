<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Content extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('logged_in'))
		{
			redirect('login');
		}
	}

	public function index()
	{
		$this->template->view('content/index');
	}

	public function create_content_update()
	{
		if($this->form_validation->run('create_content') == FALSE)
		{
			$this->template->view('content/index');
			return;
		}
	
		//--- insert new content ---
		$data_content = array(
							'subject' => $this->input->post('subject'),
							'description' => $this->input->post('editor'),
							'last_update' => date("Y-m-d H:i:s")
						);
		$this->db->insert('content', $data_content);
		//--- insert new log ---
		$content_id = get_content_id();
		$log_data = array(
						'lang_id' => '1',
						'content_id' => $content_id,
						'subject' => $this->input->post('subject'),
						'description' => $this->input->post('editor'),
						'status' => '1',
						'update_at' => date("Y-m-d H:i:s"),
						'update_by' => $this->session->userdata('user')->firstname.' '.$this->session->userdata('user')->lastname,
						'update_id' => $this->session->userdata('user')->admin_id
					);
		$this->db->insert('log_content', $log_data);
		$this->session->set_flashdata('message',array('message' => 'Create Successful'));
		redirect('content');
	}

	public function edit_content($content_id)
	{
		$_POST = get_select_content_array($content_id);

		$this->form_validation->run('edit_content');
		$this->template->view('content/edit_content');
	}

	public function edit_content_update()
	{
		
		if($this->form_validation->run('edit_content') == FALSE)
		{
			$data['content_id'] = $this->input->post('content_id');
			$this->template->view('content/edit_content');
			return;
		}
		//echo $this->input->post('description');
		//exit;
		$content_id = $this->input->post('content_id');
		//$subject = $this->input->post('subject');
		//$description = $this->input->post('editor');
		$data_content= array(
								'subject' => $this->input->post('subject'),
								'description' => $this->input->post('description'),
								'last_update' => date("Y-m-d H:i:s")
							);		
		$this->db->where('content_id', $content_id);
		$this->db->update('content', $data_content);

		//--- insert log content ---
		$log_data = array(
						'lang_id' => '1',
						'content_id' => $content_id,
						'subject' => $this->input->post('subject'),
						'description' => $this->input->post('description'),
						'status' => '2',
						'update_at' => date("Y-m-d H:i:s"),
						'update_by' => $this->session->userdata('user')->firstname.' '.$this->session->userdata('user')->lastname,
						'update_id' => $this->session->userdata('user')->admin_id
					);
		$this->db->insert('log_content', $log_data);
		$this->session->set_flashdata('message',array('message' => 'Edit Successful'));
		redirect('content');
	}

	public function delect_content($content_id)
	{
		$get_content = get_select_content_array($content_id);
		
		//---- log delete content ----
		$log_data = array(
						'lang_id' => '1',
						'content_id' => $get_content['content_id'],
						'subject' => $get_content['subject'],
						'description' => $get_content['description'],
						'status' => '3',
						'update_at' => date("Y-m-d H:i:s"),
						'update_by' => $this->session->userdata('user')->firstname.' '.$this->session->userdata('user')->lastname,
						'update_id' => $this->session->userdata('user')->admin_id
					);
		$this->db->insert('log_content', $log_data);
		
		//---- log delete shipping range ----
		$this->db->where('content_id', $content_id);
		$this->db->delete('content');
		$this->session->set_flashdata('message',array('message' => 'Delete Successful'));
		redirect('content');
	}
}
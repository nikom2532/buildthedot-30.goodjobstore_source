<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends MY_Controller 
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
		
	}

	//-------------------------------------------------
	//------------- AJAX Category Create --------------
	//-------------------------------------------------
	function select_level()
	{
		if(!empty($_POST['sel_lv']))
		{
			$sel_lv = $_POST['sel_lv'];
			if($sel_lv!='1')
			{
				$sel_lv1 = $_POST['sel_lv1'];
				echo "<select name='sel_lv1' id='sel_lv1' class='styled' onChange=\"select_main('".base_url()."', '', '');\">";
				echo "	<option value='0'>----- select main -----</option>";
				foreach(get_dropdown_category_lv1() as $value):
					echo " <option value='".$value->cat_id."'";
					if($sel_lv1==$value->cat_id)
						echo " selected='selected'";
					echo ">".$value->name."</option>";
				endforeach;
				echo "</select>";
			}
		}
	}
	function select_main()
	{
		if(!empty($_POST['sel_lv']))
		{
			$sel_lv = $_POST['sel_lv'];
			if($sel_lv=='3')
			{
				echo "<select name='sel_lv2' id='sel_lv2' class='styled'>";
				echo "	<option value='0'>----- select sub -----</option>";
				if(!empty($_POST['sel_lv1']))
				{
					$sel_lv1 = $_POST['sel_lv1'];
					$sel_lv2 = $_POST['sel_lv2'];
					foreach(get_dropdown_category_lv2($sel_lv1) as $value):
						echo " <option value='".$value->cat_id."'";
						if($sel_lv2==$value->cat_id)
							echo " selected='selected'";
						echo ">".$value->name."</option>";
					endforeach;
				}
				echo "</select>";
			}
		}
	}

	//-------------------------------------------------
	//-------------- Delete Category ------------------
	//-------------------------------------------------

	function sublv2_delete($cat_id)
	{
		$get_sublv2 = get_select_category($cat_id);
		$log_data_lv2 = array(
						'lang_id' => '1',
						'cat_id' => $get_sublv2->cat_id,
						'name' => $get_sublv2->name,
						'level' => $get_sublv2->level,
						'main_id' => $get_sublv2->main_id,
						'main_name' => get_cat_name($get_sublv2->main_id),
						'sub_id' => $get_sublv2->sub_id,
						'sub_name' => get_cat_name($get_sublv2->sub_id),
						'rank' => $get_sublv2->rank,
						'public' => $get_sublv2->public,
						'url' => $get_sublv2->url,
						'title' => $get_sublv2->title,
						'meta_keyword' => $get_sublv2->meta_keyword,
						'meta_description' => $get_sublv2->meta_description,
						'status' => '3',
						'update_at' => date("Y-m-d H:i:s"),
						'update_by' => $this->session->userdata('user')->firstname.' '.$this->session->userdata('user')->lastname,
						'update_id' => $this->session->userdata('user')->admin_id
					);
		$this->db->insert('log_categories', $log_data_lv2);

		//---- delete sublv2 ----
			//---- default ----
			$this->db->where('cat_id', $get_sublv2->cat_id);
			$this->db->delete('categories');
			//---- other language ----
			$this->db->where('cat_id', $get_sublv2->cat_id);
			$this->db->delete('categories_lang');
		$this->session->set_flashdata('message',array('message' => 'Delete Successful'));
		redirect('category/view/'.get_select_category($get_sublv2->main_id)->url.'/'.get_select_category($get_sublv2->sub_id)->url);
	}
		
	function sublv1_delete($cat_id)
	{
		//---- delete son node ----
		$get_sublv2 = get_category_sub2_list($cat_id);
		foreach($get_sublv2 as $get_sublv2)
		{
			$log_data_lv2 = array(
							'lang_id' => '1',
							'cat_id' => $get_sublv2->cat_id,
							'name' => $get_sublv2->name,
							'level' => $get_sublv2->level,
							'main_id' => $get_sublv2->main_id,
							'main_name' => get_cat_name($get_sublv2->main_id),
							'sub_id' => $get_sublv2->sub_id,
							'sub_name' => get_cat_name($get_sublv2->sub_id),
							'rank' => $get_sublv2->rank,
							'public' => $get_sublv2->public,
							'url' => $get_sublv2->url,
							'title' => $get_sublv2->title,
							'meta_keyword' => $get_sublv2->meta_keyword,
							'meta_description' => $get_sublv2->meta_description,
							'status' => '3',
							'update_at' => date("Y-m-d H:i:s"),
							'update_by' => $this->session->userdata('user')->firstname.' '.$this->session->userdata('user')->lastname,
							'update_id' => $this->session->userdata('user')->admin_id
						);
			$this->db->insert('log_categories', $log_data_lv2);

			//---- delete sublv2 ----
				//---- default ----
				$this->db->where('cat_id', $get_sublv2->cat_id);
				$this->db->delete('categories');
				//---- other language ----
				$this->db->where('cat_id', $get_sublv2->cat_id);
				$this->db->delete('categories_lang');
		}
		//---- end delete son node ----

		//---- delete sublv1 ----
		$get_sublv1 = get_select_category($cat_id);
		$log_data_lv1 = array(
						'lang_id' => '1',
						'cat_id' => $get_sublv1->cat_id,
						'name' => $get_sublv1->name,
						'level' => $get_sublv1->level,
						'main_id' => $get_sublv1->main_id,
						'main_name' => get_cat_name($get_sublv1->main_id),
						'rank' => $get_sublv1->rank,
						'public' => $get_sublv1->public,
						'url' => $get_sublv1->url,
						'title' => $get_sublv1->title,
						'meta_keyword' => $get_sublv1->meta_keyword,
						'meta_description' => $get_sublv1->meta_description,
						'status' => '3',
						'update_at' => date("Y-m-d H:i:s"),
						'update_by' => $this->session->userdata('user')->firstname.' '.$this->session->userdata('user')->lastname,
						'update_id' => $this->session->userdata('user')->admin_id
					);
		$this->db->insert('log_categories', $log_data_lv1);

		//---- delete sublv1 ----
			//---- default ----
			$this->db->where('cat_id', $get_sublv1->cat_id);
			$this->db->delete('categories');
			//---- other language ----
			$this->db->where('cat_id', $get_sublv1->cat_id);
			$this->db->delete('categories_lang');
		$this->session->set_flashdata('message',array('message' => 'Delete Successful'));
		redirect('category/view/'.get_select_category($get_sublv1->main_id)->url);
	}

	function main_delete($cat_id)
	{
		//---- delete son node ----
			//--- sub lv1 ---
			$get_sublv1 = get_category_sub_list($cat_id);
			foreach($get_sublv1 as $get_sublv1)
			{
				//--- sub lv2 ---
				$get_sublv2 = get_category_sub2_list($get_sublv1->cat_id);
				foreach($get_sublv2 as $get_sublv2)
				{					
					$log_data_lv2 = array(
									'lang_id' => '1',
									'cat_id' => $get_sublv2->cat_id,
									'name' => $get_sublv2->name,
									'level' => $get_sublv2->level,
									'main_id' => $get_sublv2->main_id,
									'main_name' => get_cat_name($get_sublv2->main_id),
									'sub_id' => $get_sublv2->sub_id,
									'sub_name' => get_cat_name($get_sublv2->sub_id),
									'rank' => $get_sublv2->rank,
									'public' => $get_sublv2->public,
									'url' => $get_sublv2->url,
									'title' => $get_sublv2->title,
									'meta_keyword' => $get_sublv2->meta_keyword,
									'meta_description' => $get_sublv2->meta_description,
									'status' => '3',
									'update_at' => date("Y-m-d H:i:s"),
									'update_by' => $this->session->userdata('user')->firstname.' '.$this->session->userdata('user')->lastname,
									'update_id' => $this->session->userdata('user')->admin_id
								);
					$this->db->insert('log_categories', $log_data_lv2);

					//---- delete sublv2 ----
						//---- default ----
						$this->db->where('cat_id', $get_sublv2->cat_id);
						$this->db->delete('categories');
						//---- other language ----
						$this->db->where('cat_id', $get_sublv2->cat_id);
						$this->db->delete('categories_lang');
				}
				//--- end sub lv2 ---
				$log_data_lv1 = array(
								'lang_id' => '1',
								'cat_id' => $get_sublv1->cat_id,
								'name' => $get_sublv1->name,
								'level' => $get_sublv1->level,
								'main_id' => $get_sublv1->main_id,
								'main_name' => get_cat_name($get_sublv1->main_id),
								'rank' => $get_sublv1->rank,
								'public' => $get_sublv1->public,
								'url' => $get_sublv1->url,
								'title' => $get_sublv1->title,
								'meta_keyword' => $get_sublv1->meta_keyword,
								'meta_description' => $get_sublv1->meta_description,
								'status' => '3',
								'update_at' => date("Y-m-d H:i:s"),
								'update_by' => $this->session->userdata('user')->firstname.' '.$this->session->userdata('user')->lastname,
								'update_id' => $this->session->userdata('user')->admin_id
							);
				$this->db->insert('log_categories', $log_data_lv1);

				//---- delete sublv1 ----
					//---- default ----
					$this->db->where('cat_id', $get_sublv1->cat_id);
					$this->db->delete('categories');
					//---- other language ----
					$this->db->where('cat_id', $get_sublv1->cat_id);
					$this->db->delete('categories_lang');
			}
			//--- end sub lv1 ---
		//---- delete main category ----
		$get_main = get_select_category($cat_id);
		$log_data_main = array(
						'lang_id' => '1',
						'cat_id' => $get_main->cat_id,
						'name' => $get_main->name,
						'level' => $get_main->level,
						'main_id' => $get_main->main_id,
						'main_name' => get_cat_name($get_main->main_id),
						'sub_id' => $get_main->sub_id,
						'sub_name' => get_cat_name($get_main->sub_id),
						'rank' => $get_main->rank,
						'public' => $get_main->public,
						'url' => $get_main->url,
						'title' => $get_main->title,
						'meta_keyword' => $get_main->meta_keyword,
						'meta_description' => $get_main->meta_description,
						'status' => '3',
						'update_at' => date("Y-m-d H:i:s"),
						'update_by' => $this->session->userdata('user')->firstname.' '.$this->session->userdata('user')->lastname,
						'update_id' => $this->session->userdata('user')->admin_id
					);
		$this->db->insert('log_categories', $log_data_main);

		//---- delete sublv2 ----
			//---- default ----
			$this->db->where('cat_id', $get_main->cat_id);
			$this->db->delete('categories');
			//---- other language ----
			$this->db->where('cat_id', $get_main->cat_id);
			$this->db->delete('categories_lang');
		$this->session->set_flashdata('message',array('message' => 'Delete Successful'));
		redirect('category');
	}

	//-------------------------------------------------
	//--------------------- VIEW ----------------------
	//-------------------------------------------------
	public function view($main_url=NULL, $sub_url=NULL)
	{
		if($main_url==NULL AND $sub_url==NULL)
		{	
			
			$this->template->view('category/view');
		}
		else if($sub_url==NULL)
		{
			$data['main_url'] = $main_url;
			$this->template->view('category/sublv1', $data);
		}
		else
		{
			$data['main_url'] = $main_url;	
			$data['sub_url'] = $sub_url;
			$this->template->view('category/sublv2', $data );
				
		}
	}
	
	public function create()
	{
		$this->template->view('category/create');
	}

	public function create_update()
	{
		$this->form_validation->set_message('required' , 'The %s is missing.');
		if($this->form_validation->run('create_category') == FALSE )
		{
			$this->template->view('category/create');
			return;
		}
	
		//--- get rank ---
		if($this->input->post('sel_lv')==1)
			$rank = get_last_rank_lv1();
		else if($this->input->post('sel_lv')==2)
			$rank = get_last_rank_lv2($this->input->post('sel_lv1'));
		else if($this->input->post('sel_lv')==3)
			$rank = get_last_rank_lv3($this->input->post('sel_lv2'));
		//--- end get rank ---

		//--- insert new category ---

		$data_category = array(
							'name' => $this->input->post('name'),
							'level' => $this->input->post('sel_lv'),
							'main_id' => $this->input->post('sel_lv1'),
							'sub_id' => $this->input->post('sel_lv2'),
							'rank' => $rank,
							'public' => $this->input->post('public'),
							'url' => $this->input->post('url'),
							'title' => $this->input->post('title'),
							'meta_keyword' => $this->input->post('meta_keyword'),
							'meta_description' => $this->input->post('meta_description')
						);
		$this->db->insert('categories', $data_category);


		//---- insert log new category ----
		$cat_id = get_cat_id();
		$log_data = array(
						'lang_id' => '1',
						'cat_id' => $cat_id,
						'name' => $this->input->post('name'),
						'level' => $this->input->post('sel_lv'),
						'main_id' => $this->input->post('sel_lv1'),
						'main_name' => get_cat_name($this->input->post('sel_lv1')),
						'sub_id' => $this->input->post('sel_lv2'),
						'sub_name' => get_cat_name($this->input->post('sel_lv2')),
						'rank' => $rank,
						'public' => $this->input->post('public'),
						'url' => $this->input->post('url'),
						'title' => $this->input->post('title'),
						'meta_keyword' => $this->input->post('meta_keyword'),
						'meta_description' => $this->input->post('meta_description'),
						'status' => '1',
						'update_at' => date("Y-m-d H:i:s"),
						'update_by' => $this->session->userdata('user')->firstname.' '.$this->session->userdata('user')->lastname,
						'update_id' => $this->session->userdata('user')->admin_id
					);
		$this->db->insert('log_categories', $log_data);

		$this->session->set_flashdata('message',array('message' => 'Create Successful'));
		
		//---- redirect ----
		if($this->input->post('level')=='1')
			$next_url = "category";
		else if($this->input->post('level')=='2')
			$next_url = "category/view/".get_cat_url_from_id($this->input->post('sel_lv1'));
		else
			$next_url = "category/view/".get_cat_url_from_id($this->input->post('sel_lv1'))."/".get_cat_url_from_id($this->input->post('sel_lv2'));
		$this->session->set_flashdata('message',array('message' => 'Create Successful'));
		redirect($next_url);
	}
	
	
	public function edit_cat($main_url=NULL, $sublv1_url=NULL, $sublv2_url=NULL)
	{
	    $data['main_url'] = $main_url;
	    $data['sublv1_url'] = $sublv1_url;
	    $data['sublv2_url'] = $sublv2_url;

		if($sublv1_url==NULL AND $sublv2_url==NULL)
			$_POST = get_select_category_array_from_url($main_url);
		else if($sublv2_url==NULL)
			$_POST = get_select_category_array_from_url($sublv1_url);
		else
			$_POST = get_select_category_array_from_url($sublv2_url);

		$this->form_validation->run('edit_category');

		$this->template->view('category/edit' , $data);
	}
	
	public function edit_cat_update()
	{
		if($this->form_validation->run('edit_category') == FALSE)
		{
			$data['main_url'] = $this->input->post('main_url');
			$data['sublv1_url'] = $this->input->post('sublv1_url');
			$data['sublv2_url'] = $this->input->post('sublv2_url');

		if($this->input->post('sublv1_url')==NULL AND $this->input->post('sublv2_url')==NULL)
			$_POST = get_select_category_array_from_url($this->input->post('main_url'));
		else if($this->input->post('sublv2_url')==NULL)
			$_POST = get_select_category_array_from_url($this->input->post('sublv1_url'));
		else
			$_POST = get_select_category_array_from_url($this->input->post('sublv2_url'));
			
		$this->template->view('category/edit' , $data);
		return;
		
		}

		$data_category = array(
							'cat_id' => $this->input->post('cat_id'),
							'name' => $this->input->post('name'),
							'level' => $this->input->post('level'),
							'main_id' => $this->input->post('main_id'),
							'sub_id' => $this->input->post('sub_id'),
							'rank' => $this->input->post('rank'),
							'public' => $this->input->post('public'),
							'url' => $this->input->post('url'),
							'title' => $this->input->post('title'),
							'meta_keyword' => $this->input->post('meta_keyword'),
							'meta_description' => $this->input->post('meta_description')
						);
		$this->db->where('cat_id', $this->input->post('cat_id'));
		$this->db->update('categories', $data_category);

		
		//---- insert log edit category ----
		$log_data = array(
						'lang_id' => '1',
						'cat_id' => $this->input->post('cat_id'),
						'name' => $this->input->post('name'),
						'level' => $this->input->post('level'),
						'main_id' => $this->input->post('main_id'),
						'main_name' => get_cat_name($this->input->post('main_id')),
						'sub_id' => $this->input->post('sub_id'),
						'sub_name' => get_cat_name($this->input->post('sub_id')),
						'rank' => $this->input->post('rank'),
						'public' => $this->input->post('public'),
						'url' => $this->input->post('url'),
						'title' => $this->input->post('title'),
						'meta_keyword' => $this->input->post('meta_keyword'),
						'meta_description' => $this->input->post('meta_description'),
						'status' => '2',
						'update_at' => date("Y-m-d H:i:s"),
						'update_by' => $this->session->userdata('user')->firstname.' '.$this->session->userdata('user')->lastname,
						'update_id' => $this->session->userdata('user')->admin_id
					);
		$this->db->insert('log_categories', $log_data);

/*
		echo "TEST: <BR>";
		var_dump($data_category);
		echo "<hr>";
		echo "<BR>cat_id: ".$data_category['cat_id'];
		echo "<BR>name: ".$data_category['name'];
		echo "<BR>level: ".$data_category['level'];
		echo "<BR>main_id: ".$data_category['main_id'];
		echo "<BR>sub_id: ".$data_category['sub_id'];
		echo "<BR>rank: ".$data_category['rank'];
		echo "<BR>public: ".$data_category['public'];
		echo "<BR>url: ".$data_category['url'];
		echo "<BR>title: ".$data_category['title'];
		echo "<BR>meta_keyword: ".$data_category['meta_keyword'];
		echo "<BR>meta_description: ".$data_category['meta_description'];
		
		echo "<hr>";
		echo "url: ";
		
		if($this->input->post('level')=='1')
			echo "category";
		else if($this->input->post('level')=='2')
			echo "category/view/".get_cat_url_from_id($this->input->post('main_id'));
		else
			echo "category/view/".get_cat_url_from_id($this->input->post('main_id'))."/".get_cat_url_from_id($this->input->post('sub_id'));

		exit;
*/



		//---- redirect ----
		if($this->input->post('level')=='1')
			$next_url = "category";
		else if($this->input->post('level')=='2')
			$next_url = "category/view/".get_cat_url_from_id($this->input->post('main_id'));
		else
			$next_url = "category/view/".get_cat_url_from_id($this->input->post('main_id'))."/".get_cat_url_from_id($this->input->post('sub_id'));
		$this->session->set_flashdata('message',array('message' => 'Edit Successful'));
		redirect($next_url);

	}
	//---- check validate -----// 
	
	public function check_select_lv1()
	{
		if($this->input->post('sel_lv')==2 OR $this->input->post('sel_lv')==3)
		{
			if($this->input->post('sel_lv1') == 0)
			{
				$this->form_validation->set_message('check_select_lv1' , 'Plese Select Main');
				return FALSE;
			}
			return TRUE ;
		}
		else 
		{
			return TRUE ;
		}
	
	}
		
	public function check_select_lv2()
	{
		if($this->input->post('sel_lv')==3)
		{
			if($this->input->post('sel_lv2') == 0)
			{
				$this->form_validation->set_message('check_select_lv2' , 'Plese Select Sub lv1');
				return FALSE;
			}
			return TRUE ;
		}
		else 
		{
			return TRUE ;
		}
	 
	}
	
	public function check_name_category($name)
	{
		$ci =& get_instance();

		$query = $ci->db->get_where('categories', array('name'=>$name))->row();
		if(!empty($query))
		{
			
			$this->form_validation->set_message('check_name_category' , 'Name is already used');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
		
	}
	
	public function check_url_category($url)
	{
		$ci =& get_instance();

		$query = $ci->db->get_where('categories', array('url'=>$url))->row();
		if(!empty($query))
		{
			$this->form_validation->set_message('check_url_category' , 'Url is already used');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	

	public function check_edit_url_category()
	{
		$cat_id = $this->input->post('cat_id');
		$url = $this->input->post('url');
		$ci =& get_instance();

		$ci->db->where('cat_id !=', $cat_id);
		$query = $ci->db->get_where('categories', array('url'=>$url))->row();
		if(!empty($query))
		{
			$this->form_validation->set_message('check_edit_url_category' , 'Url is already used');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	public function check_edit_name_category()
	{
	
		$cat_id = $this->input->post('cat_id');
		$name = $this->input->post('name');
		$ci =& get_instance();

		$ci->db->where('cat_id !=', $cat_id);
		$query = $ci->db->get_where('categories', array('name'=>$name))->row();
		if(!empty($query))
		{
			$this->form_validation->set_message('check_edit_name_category' , 'Name is already used');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}	
	//---- end check validate -----//
}
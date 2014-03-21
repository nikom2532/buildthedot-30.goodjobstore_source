<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends MY_Controller 
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
		$this->template->view('product/view');
	}
	
	
	public function view($group_url=NULL , $product_id=NULL)
	{
		if($group_url==NULL AND $product_id==NULL)
		{	
			$this->template->view('product/view');
		}
		else if($product_id==NULL)
		{
			$data['group_detail'] = get_select_product_group($group_url);
			$this->template->view('product/view_group', $data);
		}
		else
		{
			$data['product_detail'] = get_select_product($product_id);
			$data['group_detail'] = get_select_product_group($group_url);
			$this->template->view('product/view_product' , $data);
		}
	}
	
	//##########################################################################################
	//#################################### Product Group #######################################
	//##########################################################################################
	function remove_product_group($progroup_url)
	{
		$progroup_id = get_select_product_group($progroup_url)->progroup_id;

		//---- re run rank ----
		foreach(product_group_remove_rank($progroup_id) as $value)
		{
			$new_rank = $value->rank - 1;
			$this->db->where('progroup_id', $value->progroup_id);
			$this->db->update('pro_group', array('rank' => $new_rank));
		}

		$query_group = get_product_from_group_name($progroup_url);
		if(!empty($query_group))
		{
			foreach($query_group as $value_group)
			{
				//---- remove product images ----
				$query_product = get_product_img_from_id($value_group->product_id);
				if(!empty($query_product))
				{
					foreach($query_product as $value_product)
					{
						$img_path = $value_product->path;
						@unlink($img_path);
					}
					$this->db->where('product_id', $value_group->product_id);
					$this->db->delete('product_img');
				}

				//---- remove keyword ----
				$this->db->where('product_id', $value_group->product_id);
				$this->db->delete('keyword_list');

				//---- insert log product ----
				$get_product = get_select_product($value_group->product_id);
				$log_data = array(
								'lang_id' => '1',
								'product_id' => $value_group->product_id,
								'progroup_id' => $get_product->progroup_id,
								'name' => $get_product->name,
								'description' => $get_product->description,
								'price' => $get_product->price,
								'color' => get_color_name($get_product->color_id),
								'property' => get_property_name($get_product->prop_id),
								'attribute' => get_attribute_name($get_product->attribute_id),
								'size' => $get_product->size,
								'weight' => $get_product->weight,
								'qty' => $get_product->qty,
								'flag' => $get_product->flag,
								'discount' => $get_product->discount,
								'discount_type' => $get_product->discount_type,
								'public' => $get_product->public,
								'rank' => $get_product->rank,
								'primary' => $get_product->primary,
								'status' => '3',
								'update_at' => date("Y-m-d H:i:s"),
								'update_by' => $this->session->userdata('user')->firstname.' '.$this->session->userdata('user')->lastname,
								'update_id' => $this->session->userdata('user')->admin_id
							);
				$this->db->insert('log_products', $log_data);
				//---- remove product ----
				$this->db->where('product_id', $value_group->product_id);
				$this->db->delete('products');
			}
		}
		
		//---- remove keyword group ----
		$this->db->where('progroup_id', $progroup_id);
		$this->db->delete('keygroup_list');

		//---- insert log product group ----
		$get_product_group = get_select_product_group($progroup_url);
		$log_data = array(
						'lang_id' => '1',
						'progroup_id' => $get_product_group->progroup_id,
						'name' => $get_product_group->name,
						'public' => $get_product_group->public,
						'rank' => $get_product_group->rank,
						'url' => $get_product_group->url,
						'title' => $get_product_group->title,
						'meta_description' => $get_product_group->meta_description,
						'status' => '3',
						'update_at' => date("Y-m-d H:i:s"),
						'update_by' => $this->session->userdata('user')->firstname.' '.$this->session->userdata('user')->lastname,
						'update_id' => $this->session->userdata('user')->admin_id
					);
		$this->db->insert('log_pro_group', $log_data);
		//---- remove product ----
		$this->db->where('progroup_id', $progroup_id);
		$this->db->delete('pro_group');
		$this->session->set_flashdata('message',array('message' => 'Remove Successful'));
		redirect('product');
	}

	public function manage_product_group()
	{
		$this->template->view('product/manage_product_group');
	}
	public function manage_product_group_update()
	{
		//--- substring to array ---
		$manage_rank = explode(" ", $this->input->post('manage_rank'));

		$i=1;
		foreach($manage_rank as $value)
		{			
			$this->db->where('progroup_id', $value);
			$this->db->update('pro_group', array('rank' => $i));

			$i++;
		}
		$this->session->set_flashdata('message',array('message' => 'Edit Successful'));
		redirect('product');
	}

	public function create_product_group()
	{
		$this->template->view('product/create_product_group');
	}
	
	public function create_product_group_update()
	{
		$this->form_validation->set_message('required', '%s is missing.');
		if($this->form_validation->run('create_product_group') == FALSE)
		{
			$this->template->view('product/create_product_group');
			return;
		}
		//--- insert new product group ---
		$data_pro_group = array(
							'progroup_id' => $this->input->post('progroup_id'),
							'name' => $this->input->post('name'),
							'public' => $this->input->post('public'),
							'rank' => get_last_rank_pro_group(),
							'url' => $this->input->post('url'),
							'title' => $this->input->post('title'),
							'meta_description' => $this->input->post('meta_description')
						);
		$this->db->insert('pro_group', $data_pro_group);

		//--- insert log data ---
		$log_data = array(
						'lang_id' => '1',
						'progroup_id' => $this->input->post('progroup_id'),
						'name' => $this->input->post('name'),
						'public' => $this->input->post('public'),
						'rank' => get_last_rank_pro_group(),
						'url' => $this->input->post('url'),
						'title' => $this->input->post('title'),
						'meta_description' => $this->input->post('meta_description'),
						'status' => '1',
						'update_at' => date("Y-m-d H:i:s"),
						'update_by' => $this->session->userdata('user')->firstname.' '.$this->session->userdata('user')->lastname,
						'update_id' => $this->session->userdata('user')->admin_id
					);
		$this->db->insert('log_pro_group', $log_data);
		
		//-- insert keyword group ---
		$meta_keyword = $this->input->post('meta_keyword');
		if($meta_keyword)
		{
			for($i=0;$i<count($meta_keyword);$i++)
			{
				$this->db->insert('keygroup_list', array('keygroup_id'=>$meta_keyword[$i], 'progroup_id'=>$this->input->post('progroup_id')));
			}
		}
		$this->session->set_flashdata('message',array('message' => 'Create Successful'));
		redirect('product');
	}
	
	public function edit_product_group($group_url)
	{
		$data['group_detail'] = get_select_product_group($group_url);
		//$_POST = get_select_product_group_array($group_url);
		
		$arr_1 = get_select_product_group_array($group_url);
		$arr_2 = array('select_id'=>$arr_1['progroup_id']);
		$_POST = array_merge($arr_2, $arr_1);

		$this->form_validation->run('edit_product_group');

		$this->template->view('product/edit_product_group', $data);
	}
	
	public function edit_product_group_update()
	{
		$select_id = $this->input->post('select_id');
		$this->form_validation->set_message('required', '%s is missing.');
		
		if($this->form_validation->run('edit_product_group') == FALSE)
		{

			$this->template->view('product/edit_product_group');
			return;
		}
		
		$select_id = $this->input->post('select_id');
		

		//---- update product group ----
		$data_pro_group = array(
							'progroup_id' => $this->input->post('progroup_id'),
							'name' => $this->input->post('name'),
							'public' => $this->input->post('public'),
							'rank' => $this->input->post('rank'),
							'url' => $this->input->post('url'),
							'title' => $this->input->post('title'),
							'meta_description' => $this->input->post('meta_description')
						);		
		$this->db->where('progroup_id', $select_id);
		$this->db->update('pro_group', $data_pro_group);
		
		//---- insert log edit product group ----
		$log_data = array(
						'old_group_id' => $this->input->post('select_id'),
						'lang_id' => '1',
						'progroup_id' => $this->input->post('progroup_id'),
						'name' => $this->input->post('name'),
						'public' => $this->input->post('public'),
						'rank' => $this->input->post('rank'),
						'url' => $this->input->post('url'),
						'title' => $this->input->post('title'),
						'meta_description' => $this->input->post('meta_description'),
						'status' => '2',
						'update_at' => date("Y-m-d H:i:s"),
						'update_by' => $this->session->userdata('user')->firstname.' '.$this->session->userdata('user')->lastname,
						'update_id' => $this->session->userdata('user')->admin_id
					);
		$this->db->insert('log_pro_group', $log_data);

		//-- insert keyword group ---
		$meta_keyword = $this->input->post('meta_keyword');
		$this->db->delete('keygroup_list', array('progroup_id'=>$this->input->post('select_id')));
		if($meta_keyword)
		{
			for($i=0;$i<count($meta_keyword);$i++)
			{
				$this->db->insert('keygroup_list', array('keygroup_id'=>$meta_keyword[$i], 'progroup_id'=>$this->input->post('progroup_id')));
			}
		}
		$this->session->set_flashdata('message',array('message' => 'Edit Successful'));
		redirect('product/view/'.$this->input->post('url'));
	}

	//##########################################################################################
	//####################################### Product ##########################################
	//##########################################################################################
	function remove_product($product_id, $progroup_url)
	{
		//---- re run rank ----
		foreach(product_remove_rank($product_id) as $value)
		{
			$new_rank = $value->rank - 1;
			$this->db->where('product_id', $value->product_id);
			$this->db->update('products', array('rank' => $new_rank));
		}

		//---- remove product images ----
		$query = get_product_img_from_id($product_id);
		if(!empty($query))
		{
			foreach($query as $value)
			{
				$img_path = $value->path;
				@unlink($img_path);
			}
			$this->db->where('product_id', $product_id);
			$this->db->delete('product_img');
		}
		
		//---- remove keyword ----
		$this->db->where('product_id', $product_id);
		$this->db->delete('keyword_list');

		//---- insert log product ----
		$get_product = get_select_product($product_id);
		$log_data = array(
						'lang_id' => '1',
						'product_id' => $product_id,
						'progroup_id' => $get_product->progroup_id,
						'name' => $get_product->name,
						'description' => $get_product->description,
						'price' => $get_product->price,
						'color' => get_color_name($get_product->color_id),
						'property' => get_property_name($get_product->prop_id),
						'attribute' => get_attribute_name($get_product->attribute_id),
						'size' => $get_product->size,
						'weight' => $get_product->weight,
						'qty' => $get_product->qty,	
						'flag' => $get_product->flag,
						'discount' => $get_product->discount,
						'discount_type' => $get_product->discount_type,
						'public' => $get_product->public,
						'rank' => $get_product->rank,
						'primary' => $get_product->primary,
						'status' => '3',
						'update_at' => date("Y-m-d H:i:s"),
						'update_by' => $this->session->userdata('user')->firstname.' '.$this->session->userdata('user')->lastname,
						'update_id' => $this->session->userdata('user')->admin_id
					);
		$this->db->insert('log_products', $log_data);
		//---- remove product ----
		$this->db->where('product_id', $product_id);
		$this->db->delete('products');
		$this->session->set_flashdata('message',array('message' => 'Delete Successful'));
		redirect('product/view/'.$progroup_url);
	}

	public function create_product($group_url)
	{
		$data['group_detail'] = get_select_product_group($group_url);
		$this->template->view('product/create_product', $data);
	}
	
	public function create_update()
	{	
		//--- gen product_id & rank ---
		$product_id = get_next_product_id();
		$rank = get_next_rank_product($this->input->post('progroup_id'));
		$this->form_validation->set_message('required' , 'The %s is missing.');
		$select_id = $this->input->post('select_id');
		if($this->form_validation->run('create_product') == FALSE)
		{
			if(strlen($this->input->post('discount'))!=0 AND $this->input->post('discount')!=0)
			{
					$data['group_detail'] = get_select_product_group($this->input->post('progroup_url'));
					$this->template->view('product/create_product' , $data);
					return;
			}
			
			$data['group_detail'] = get_select_product_group($this->input->post('progroup_url'));
			$this->template->view('product/create_product' , $data);
			return;
		}

		//--- insert new product group ---
			$data_product = array(
								'product_id' => $product_id,
								'progroup_id' => $this->input->post('progroup_id'),
								'name' => $this->input->post('name'),
								'description' => $this->input->post('description'),
								'price' => $this->input->post('price'),
								'color_id' => $this->input->post('color_id'),
								'prop_id' => $this->input->post('prop_id'),
								'attribute_id' => $this->input->post('attribute_id'),
								'size' => $this->input->post('size'),
								'weight' => $this->input->post('weight'),
								'qty' => $this->input->post('qty'),
								'flag' => $this->input->post('flag'),
								'discount' => $this->input->post('discount'),
								'discount_type' => $this->input->post('discount_type'),
								'public' => $this->input->post('public'),
								'rank' => $rank,
								'primary' => $this->input->post('primary')
							);
			$this->db->insert('products', $data_product);
			
			//-- insert keyword ---
			$meta_keyword = $this->input->post('meta_keyword');
			if($meta_keyword)
			{
				for($i=0;$i<count($meta_keyword);$i++)
				{
					$this->db->insert('keyword_list', array('keyword_id'=>$meta_keyword[$i], 'product_id'=>$product_id));
				}
			}
			//---- insert image ----
			$i = 1;
			foreach($_FILES as $field_name => $file)
			{
				//---- insert image 1 ----
				$img_path = './public/images/products/';
				$config['upload_path'] = $img_path;
				$config['allowed_types'] = '*';
				$config['max_size'] = '5120';
				$this->load->library('upload', $config);
				$input_name = 'userfile'.$i;
				if($this->upload->do_upload($input_name))
				{				
					$img_detail = $this->upload->data();
					if($i == 1)
					{
						$data_img = array(
										'product_id' => $product_id,
										'path' => 'public/images/products/'.$img_detail[file_name],
										'rank' => get_last_rank_product_img($product_id),
										'primary' => '1'
									);
					}
					else
					{
						$data_img = array(
										'product_id' => $product_id,
										'path' => 'public/images/products/'.$img_detail[file_name],
										'rank' => get_last_rank_product_img($product_id),
										'primary' => '0'
									);
					}
					$this->db->insert('product_img', $data_img);
				}
				$i++;
			}

		//--- insert log data ---
		$log_data = array(
						'lang_id' => '1',
						'product_id' => $product_id,
						'progroup_id' => $this->input->post('progroup_id'),
						'name' => $this->input->post('name'),
						'description' => $this->input->post('description'),
						'price' => $this->input->post('price'),
						'color' => get_color_name($this->input->post('color_id')),
						'property' => get_property_name($this->input->post('prop_id')),
						'attribute' => get_attribute_name($this->input->post('attribute_id')),
						'size' => $this->input->post('size'),
						'weight' => $this->input->post('weight'),
						'qty' => $this->input->post('qty'),
						'flag' => $this->input->post('flag'),
						'discount' => $this->input->post('discount'),
						'discount_type' => $this->input->post('discount_type'),
						'public' => $this->input->post('public'),
						'rank' => $rank,
						'primary' => $this->input->post('primary'),
						'status' => '1',
						'update_at' => date("Y-m-d H:i:s"),
						'update_by' => $this->session->userdata('user')->firstname.' '.$this->session->userdata('user')->lastname,
						'update_id' => $this->session->userdata('user')->admin_id
					);
		$this->db->insert('log_products', $log_data);
		$this->session->set_flashdata('message',array('message' => 'Create Successful'));
		redirect('product/view/'.$this->input->post('progroup_url'));
	}

	public function manage_product($group_url)
	{
		$data['group_detail'] = get_select_product_group($group_url);

		$this->template->view('product/manage_product', $data);
	}
	public function manage_product_update()
	{
		//--- remove primary ---
		$this->db->where('progroup_id', $this->input->post('progroup_id'));
		$this->db->where('primary', '1');
		$this->db->update('products', array('primary' => '0'));
		//--- select primary ---
		$this->db->where('product_id', $this->input->post('primary'));
		$this->db->update('products', array('primary' => '1'));

		//--- substring to array ---
		$manage_rank = explode(" ", $this->input->post('manage_rank'));

		$i=1;
		foreach($manage_rank as $value)
		{
			$this->db->where('product_id', $value);
			$this->db->update('products', array('rank' => $i));

			$i++;
		}
		$this->session->set_flashdata('message',array('message' => 'Edit Successful'));
		redirect('product/view/'.$this->input->post('progroup_url'));
	}
	
	public function edit_product($group_url=NULL , $product_id=NULL)
	{
		$data['product_detail'] = get_select_product($product_id);
		$data['group_detail'] = get_select_product_group($group_url);
		$_POST = get_select_product_array($product_id);

		$this->form_validation->run('edit_product');

		$this->template->view('product/edit_product', $data);
	}
	public function edit_product_update()
	{
		$this->form_validation->set_message('required' , 'The %s is missing.');
		if($this->form_validation->run('edit_product') == FALSE)
		{
			$data['product_detail'] = get_select_product($this->input->post('product_id'));
			$data['group_detail'] = get_select_product_group($this->input->post('progroup_url'));
			$this->template->view('product/edit_product' , $data);
			return;
		}

		//---- update product group ----
		$data_product = array(
							'name' => $this->input->post('name'),
							'description' => $this->input->post('description'),
							'price' => $this->input->post('price'),
							'color_id' => $this->input->post('color_id'),
							'prop_id' => $this->input->post('prop_id'),
							'attribute_id' => $this->input->post('attribute_id'),
							'size' => $this->input->post('size'),
							'weight' => $this->input->post('weight'),
							'qty' => $this->input->post('qty'),
							'flag' => $this->input->post('flag'),
							'discount' => $this->input->post('discount'),
							'discount_type' => $this->input->post('discount_type'),
							'public' => $this->input->post('public'),
							'primary' => $this->input->post('primary')
						);
		$this->db->where('product_id',$this->input->post('product_id'));
		$this->db->update('products', $data_product);

		//--- insert log data ---
		$log_data = array(
						'lang_id' => '1',
						'product_id' => $this->input->post('product_id'),
						'progroup_id' => $this->input->post('progroup_id'),
						'name' => $this->input->post('name'),
						'description' => $this->input->post('description'),
						'price' => $this->input->post('price'),
						'color' => get_color_name($this->input->post('color_id')),
						'property' => get_property_name($this->input->post('prop_id')),
						'attribute' => get_attribute_name($this->input->post('attribute_id')),
						'size' => $this->input->post('size'),
						'weight' => $this->input->post('weight'),
						'qty' => $this->input->post('qty'),
						'flag' => $this->input->post('flag'),
						'discount' => $this->input->post('discount'),
						'discount_type' => $this->input->post('discount_type'),
						'public' => $this->input->post('public'),
						'rank' => $this->input->post('rank'),
						'primary' => $this->input->post('primary'),
						'status' => '2',
						'update_at' => date("Y-m-d H:i:s"),
						'update_by' => $this->session->userdata('user')->firstname.' '.$this->session->userdata('user')->lastname,
						'update_id' => $this->session->userdata('user')->admin_id
					);
		$this->db->insert('log_products', $log_data);
		
		//-- insert keyword group ---
		$meta_keyword = $this->input->post('meta_keyword');
		$this->db->delete('keyword_list', array('product_id'=>$this->input->post('product_id')));
		if($meta_keyword)
		{
			for($i=0;$i<count($meta_keyword);$i++)
			{
				$this->db->insert('keyword_list', array('keyword_id'=>$meta_keyword[$i], 'product_id'=>$this->input->post('product_id')));
			}
		}
		$this->session->set_flashdata('message',array('message' => 'Edit Successful'));
		redirect('product/view/'.$this->input->post('progroup_url').'/'.$this->input->post('product_id'));
	}

	//##########################################################################################
	//#################################### Product Image #######################################
	//##########################################################################################
	function remove_image($image_id, $progroup_url, $product_id)
	{
		foreach(product_image_remove_rank($image_id, $product_id) as $value)
		{
			$new_rank = $value->rank - 1;
			$this->db->where('id', $value->id);
			$this->db->update('product_img', array('rank' => $new_rank));
		}

		$img_path = get_path_select_product_img($image_id);
		//---- default ----
		$this->db->where('id', $image_id);
		$this->db->delete('product_img');

		@unlink($img_path);
		$this->session->set_flashdata('message',array('message' => 'Delete Successful'));
		redirect('product/view/'.$progroup_url.'/'.$product_id);
	}

	public function create_product_image($group_url=NULL , $product_id=NULL)
	{
		$data['product_detail'] = get_select_product($product_id);
		$data['group_detail'] = get_select_product_group($group_url);

		$this->template->view('product/create_product_image', $data);
	}

	public function create_product_image_update()
	{
		$check_validate = TRUE;
		$ermsg = "";

		if(empty($_FILES['userfile1']['name']))
        {
				$check_validate = FALSE ;
				$ermsg = "Please Select Image";			
		}
		
		if(!empty($_FILES['userfile1']['name']))
        {
			//---- insert image 1 ----
			$img_path = './public/images/products/';
			$config['upload_path'] = $img_path;
			$config['allowed_types'] = '*';
			$config['max_size'] = '5120';
			$this->load->library('upload', $config);
			//$input_name = 'userfile'.$i;
			if($this->upload->do_upload('userfile1'))
			{				
				$img_detail = $this->upload->data();
				$data_img = array(
								'product_id' => $this->input->post('product_id'),
								'path' => 'public/images/products/'.$img_detail['file_name'],
								'rank' => get_last_rank_product_img($this->input->post('product_id')),
								'primary' => '0'
							);
				$this->db->insert('product_img', $data_img);
			}
			else
			{
				$check_validate = FALSE ;
				$ermsg = "Upload 1 error";
			}
		}
		
		if(!empty($_FILES['userfile2']['name']))
        {
			//---- insert image 1 ----
			$img_path = './public/images/products/';
			$config['upload_path'] = $img_path;
			$config['allowed_types'] = '*';
			$config['max_size'] = '5120';
			$this->load->library('upload', $config);
			//$input_name = 'userfile'.$i;
			if($this->upload->do_upload('userfile2'))
			{				
				$img_detail = $this->upload->data();
				$data_img = array(
								'product_id' => $this->input->post('product_id'),
								'path' => 'public/images/products/'.$img_detail['file_name'],
								'rank' => get_last_rank_product_img($this->input->post('product_id')),
								'primary' => '0'
							);
				$this->db->insert('product_img', $data_img);
			}
			else
			{
				$check_validate = FALSE ;
				$ermsg2 = "Upload 2 error";
			}
		}
		
		if(!empty($_FILES['userfile3']['name']))
        {
			//---- insert image 1 ----
			$img_path = './public/images/products/';
			$config['upload_path'] = $img_path;
			$config['allowed_types'] = '*';
			$config['max_size'] = '5120';
			$this->load->library('upload', $config);
			//$input_name = 'userfile'.$i;
			if($this->upload->do_upload('userfile3'))
			{				
				$img_detail = $this->upload->data();
				$data_img = array(
								'product_id' => $this->input->post('product_id'),
								'path' => 'public/images/products/'.$img_detail['file_name'],
								'rank' => get_last_rank_product_img($this->input->post('product_id')),
								'primary' => '0'
							);
				$this->db->insert('product_img', $data_img);
			}
			else
			{
				$check_validate = FALSE ;
				$ermsg3 = "Upload 3 error";
			}
		}
		
		if($check_validate == FALSE)
		{
			$data['product_detail'] = get_select_product($this->input->post('product_id'));
			$data['group_detail'] = get_select_product_group($this->input->post('progroup_url'));
			$data['ermsg'] = $ermsg;
			if(isset($ermsg2))
			{
				$data['ermsg2'] = $ermsg2;
			}
			if(isset($ermsg3))
			{
				$data['ermsg3'] = $ermsg3;
			}
			$this->template->view('product/create_product_image', $data);
			return;
		}
		
		$this->session->set_flashdata('message',array('message' => 'Create Successful'));
		redirect('product/view/'.$this->input->post('progroup_url').'/'.$this->input->post('product_id'));
	}
	public function manage_product_image($group_url=NULL , $product_id=NULL)
	{
		$data['product_detail'] = get_select_product($product_id);
		$data['group_detail'] = get_select_product_group($group_url);

		$this->template->view('product/manage_product_image' , $data);
	}

	public function manage_product_image_update()
	{
		//--- remove primary ---
		$this->db->where('product_id', $this->input->post('product_id'));
		$this->db->where('primary', '1');
		$this->db->update('product_img', array('primary' => '0'));
		//--- select primary ---
		$this->db->where('id', $this->input->post('primary'));
		$this->db->update('product_img', array('primary' => '1'));

		//--- substring to array ---
		$manage_rank = explode(" ", $this->input->post('manage_rank'));

		$i=1;
		foreach($manage_rank as $value)
		{			
			$this->db->where('id', $value);
			$this->db->update('product_img', array('rank' => $i));

			$i++;
		}
		$this->session->set_flashdata('message',array('message' => 'Edit Successful'));
		redirect('product/view/'.$this->input->post('progroup_url').'/'.$this->input->post('product_id').'/images');
	}
	
	//#############################################//
	//################## Check ####################//
	//#############################################//
	public function check_name_pro_group($name)
	{	
			
		$ci =& get_instance();
		$query = $ci->db->get_where('pro_group', array('name'=>$name))->row();
		if(!empty($query))
		{
			$this->form_validation->set_message('check_name_pro_group', 'The %s is already used');
			return False;
		}
		else
		{
			return TRUE;
		}
	}
	
	public function check_url_pro_group($url)
	{	
		
		$ci =& get_instance();
		$query = $ci->db->get_where('pro_group', array('url'=>$url))->row();
		if(!empty($query))
		{
			$this->form_validation->set_message('check_url_pro_group', 'The %s is already used');
			return False;
		}
		else
		{
		return TRUE;
		}
	}
	public function check_edit_id_pro_group($select_id, $progroup_id)
	{
		$select_id = $this->input->post('select_id');
		$progroup_id = $this->input->post('progroup_id');
		$ci =& get_instance();

		$ci->db->where('progroup_id !=', $select_id);
		$query = $ci->db->get_where('pro_group', array('progroup_id'=>$progroup_id))->row();
		if(!empty($query))
		{
		$this->form_validation->set_message('check_edit_id_pro_group', 'The %s is already used');
		return FALSE;
		}
		else
		{
		return TRUE;
		}
	}
	public function check_edit_name_pro_group()
	{
		
		$select_id = $this->input->post('select_id');
		$name = $this->input->post('name');
		$ci =& get_instance();

		$ci->db->where('progroup_id !=', $select_id);
		$query = $ci->db->get_where('pro_group', array('name'=>$name))->row();
		if(!empty($query))
		{
			$this->form_validation->set_message('check_edit_name_pro_group', 'The %s is already used');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	public function check_edit_url_pro_group($select_id, $url)
	{
		$select_id = $this->input->post('select_id');
		$url = $this->input->post('url');
		
		$ci =& get_instance();

		$ci->db->where('progroup_id !=', $select_id);
		$query = $ci->db->get_where('pro_group', array('url'=>$url))->row();
		if(!empty($query))
		{
		
			$this->form_validation->set_message('check_edit_url_pro_group', 'The %s is already used');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	//#############################################//
	//############## Check Validate ###############//
	//#############################################//
	
	public function check_name_product($name)
	{
		$ci =& get_instance();

		$query = $ci->db->get_where('products', array('name'=>$name))->row();
		if(!empty($query))
		{
			$this->form_validation->set_message('check_name_product', 'The %s is already used');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	public function check_edit_name_product()
	{
		$product_id = $this->input->post('product_id');
		$name = $this->input->post('name');
		$ci =& get_instance();
			
		$ci->db->where('product_id !=', $product_id);
		$query = $ci->db->get_where('products', array('name'=>$name))->row();
		if(!empty($query))
		{
			$this->form_validation->set_message('check_edit_name_product', 'The %s is already used');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	public function check_discount_type()
	{
	
		$discount = $this->input->post('discount');
		$discount_type = $this->input->post('discount_type');

		if(strlen($discount)!= 0 AND $discount!= 0)
		{
			if($discount_type ==0)
			{
					$this->form_validation->set_message('check_discount_type' , 'Please select discount type');
					return FALSE;
			}
			else if($discount_type==1)
			{
				if($discount>100)
				{	
					$this->form_validation->set_message('check_discount_type' , 'Percent can\'t greater than 100');
					return FALSE;
				}
				return TRUE;
			}
			else
			{
				return TRUE;
			}
		}
	}
	public function check_create_product_image()
	{
		if(empty($_FILES['userfile1']['name']))
		{
			$this->form_validation->set_message('check_create_product_image' ,'Image is missing');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	//---------- End Check Validate --------//
}
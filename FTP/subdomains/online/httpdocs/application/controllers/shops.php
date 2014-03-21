<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Shops extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$data['banners'] = $this->db->get_where('images', array('Mode'=>'Fixed', 'Status'=>'Active'))->result();
		$data['slideshows'] = $this->db->get_where('images', array('Mode'=>'SlideShow', 'Status'=>'Active'))->result();

		$this->db->order_by('sort', 'asc');
		$promotions = $this->db->get_where('promotions', array('status'=>1))->row();

		if(!empty($promotions))
		{
			$data['promotions'] = array('status' => 1 ,'data' => $promotions);
		}
		else
		{
			$data['promotions'] = array('status' => 0);
		}

		$this->template->view('shops/index', $data);
	}

	function category()
	{
		$segs = $this->uri->segment_array();
		$total_segs = $this->uri->total_segments();

		$keyword = str_replace('%20', ' ', $segs[$total_segs]);
		//$keyword = $key;

		/*$this->db->where('Pro_Name_En', $key);
		$this->db->or_where('Url_En', $key);
		$product = $this->db->get('products')->row();*/

		$this->db->where('Group_Name_En', $keyword);
		$this->db->or_where('Group_Url_En', $keyword);
		$product = $this->db->get('product_groups')->row();

		if(!empty($product))
		{
			foreach ($segs as $key => $value)
			{
				if($key==$total_segs)
				{
					$nav_arr["nav_{$key}"] = array('name'=>$this->_get_product_url(str_replace('%20', ' ', $value)), 'link'=>site_url("{$value}"), 'current'=>TRUE);
				}
				else
				{
					if($key-1 == 1)
					{
						$nav_arr["nav_{$key}"] = array('name'=>$this->_get_menu_url($key-1, $value), 'link'=>site_url("{$segs[$key-1]}/{$value}"), 'current'=>FALSE);
					}
					elseif($key-1 == 2)
					{
						$nav_arr["nav_{$key}"] = array('name'=>$this->_get_menu_url($key-1, $value), 'link'=>site_url("{$segs[$key-2]}/{$segs[$key-1]}/{$value}"), 'current'=>FALSE);
					}
					elseif($key-1 == 3)
					{
						$nav_arr["nav_{$key}"] = array('name'=>$this->_get_menu_url($key-1, $value), 'link'=>site_url("{$segs[$key-3]}/{$segs[$key-2]}/{$segs[$key-1]}/{$value}"), 'current'=>FALSE);
					}
					elseif($key-1 == 4)
					{
						$nav_arr["nav_{$key}"] = array('name'=>$this->_get_menu_url($key-1, $value), 'link'=>site_url("{$segs[$key-4]}/{$segs[$key-3]}/{$segs[$key-2]}/{$segs[$key-1]}/{$value}"), 'current'=>FALSE);
					}
					elseif($key==1)
					{
						$nav_arr["nav_{$key}"] = array('name'=>'Home', 'link'=>site_url(''), 'current'=>FALSE);
					}
				}
			}

			//$product_group = $this->db->get_where('product_groups', array('Group_Url_En'=>$keyword))->row();
			//if($product_group)
			//{
			//echo $product->Product_Code;
			//exit();

			$this->_item(NULL, $nav_arr, $product->Product_Code);
			//}
			//else
			//{
				//echo $product_group->Product_Code;
			//	$this->_item($product->Product_ID, $nav_arr);
			//}

		}
		else
		{
			$data['cat_arr'] = $segs;
			$data['cat_id'] = $keyword;
			$data['min_value'] = NULL;
			$data['max_value'] = NULL;

			foreach ($segs as $key => $value)
			{
				if($key==$total_segs)
				{
					if($key-1 == 1)
					{
						$nav_arr["nav_{$key}"] = array('name'=>$this->_get_menu_url($key-1, $value), 'link'=>site_url("{$segs[$key-1]}/{$value}"), 'current'=>TRUE);
					}
					elseif($key-1 == 2)
					{
						$nav_arr["nav_{$key}"] = array('name'=>$this->_get_menu_url($key-1, $value), 'link'=>site_url("{$segs[$key-2]}/{$segs[$key-1]}/{$value}"), 'current'=>TRUE);
					}
					elseif($key-1 == 3)
					{
						$nav_arr["nav_{$key}"] = array('name'=>$this->_get_menu_url($key-1, $value), 'link'=>site_url("{$segs[$key-3]}/{$segs[$key-2]}/{$segs[$key-1]}/{$value}"), 'current'=>TRUE);
					}
					elseif($key-1 == 4)
					{
						$nav_arr["nav_{$key}"] = array('name'=>$this->_get_menu_url($key-1, $value), 'link'=>site_url("{$segs[$key-4]}/{$segs[$key-3]}/{$segs[$key-2]}/{$segs[$key-1]}/{$value}"), 'current'=>TRUE);
					}

					elseif($key==1)
					{
						$nav_arr["nav_{$key}"] = array('name'=>'Home', 'link'=>site_url(''), 'current'=>FALSE);
					}
				}
				else
				{
					if($key-1 == 1)
					{
						$nav_arr["nav_{$key}"] = array('name'=>$this->_get_menu_url($key-1, $value), 'link'=>site_url("{$segs[$key-1]}/{$value}"), 'current'=>FALSE);
					}
					elseif($key-1 == 2)
					{
						$nav_arr["nav_{$key}"] = array('name'=>$this->_get_menu_url($key-1, $value), 'link'=>site_url("{$segs[$key-2]}/{$segs[$key-1]}/{$value}"), 'current'=>FALSE);
					}
					elseif($key-1 == 3)
					{
						$nav_arr["nav_{$key}"] = array('name'=>$this->_get_menu_url($key-1, $value), 'link'=>site_url("{$segs[$key-3]}/{$segs[$key-2]}/{$segs[$key-1]}/{$value}"), 'current'=>FALSE);
					}
					elseif($key-1 == 4)
					{
						$nav_arr["nav_{$key}"] = array('name'=>$this->_get_menu_url($key-1, $value), 'link'=>site_url("{$segs[$key-4]}/{$segs[$key-3]}/{$segs[$key-2]}/{$segs[$key-1]}/{$value}"), 'current'=>FALSE);
					}
					elseif($key==1)
					{
						$nav_arr["nav_{$key}"] = array('name'=>'Home', 'link'=>site_url(''), 'current'=>FALSE);
					}
				}
			}

			$data['nav_arr'] = $nav_arr;

			/*if($sub_id!=NULL)
			{
				$this->db->select('sub_menu.Sub_ID, sub_menu.main_ID, sub_menu.Name_Th as sub_name_Name_Th, sub_menu.Name_En as sub_name_Name_En, main_menu.main_ID, main_menu.Name_Th as main_menu_Name_Th, main_menu.Name_En as main_menu_Name_En');
				$this->db->from('sub_menu');
				$this->db->join('main_menu', 'main_menu.main_ID = sub_menu.main_ID');
				$this->db->where('sub_menu.Sub_ID', $sub_id);
				$query = $this->db->get()->row();

				$data['nav_1'] = array('name'=>$query->main_menu_Name_En, 'link'=>site_url("category/{$cat_id}"), 'current'=>FALSE);
				$data['nav_2'] = array('name'=>$query->sub_name_Name_En, 'link'=>site_url("category/{$cat_id}/{$sub_id}"), 'current'=>TRUE);

				$nav_arr = array(
					'nav_1' => $data['nav_1'],
					'nav_2' => array('name'=>$query->sub_name_Name_En, 'link'=>site_url("category/{$cat_id}/{$sub_id}"), 'current'=>FALSE)
				);

				$this->session->set_userdata('nav', $nav_arr);
			}
			elseif($cat_id!=NULL)
			{
				$query = $this->db->get_where('main_menu', array('main_ID' => $cat_id))->row();
				$data['nav_1'] = array('name'=>$query->Name_En, 'link'=>site_url("category/{$cat_id}"), 'current'=>TRUE);

				$nav_arr = array(
					'nav_1' => array('name'=>$query->Name_En, 'link'=>site_url("category/{$cat_id}"), 'current'=>FALSE)
				);

				$this->session->set_userdata('nav', $nav_arr);
			}*/

			$this->template->view('shops/category', $data);
		}
	}

	function search($keyword=NULL)
	{
		$data['keyword'] = $keyword;
		$data['nav_1'] = array('name'=>'Search', 'link'=>'search', 'current'=>TRUE);
		$this->template->view('shops/search', $data);
	}

	function searching()
	{
		$keyword = $this->input->post('search_query');

		if(empty($keyword))
		{
			echo '<script>window.history.back()</script>';
			return;
		}
		redirect("search/{$keyword}");
	}

	function _item($product_id=NULL, $nav_arr, $product_group=NULL)
	{
		if($product_group===NULL)
		{
			echo '<script>window.history.back()</script>';
			return;
		}
		$data['nav_arr'] = $nav_arr;
		$data['product_id'] = $product_id;
		$data['product_code'] = $product_group;
		$this->template->view('shops/item', $data);
	}

	function item($product_id=NULL)
	{
		if($product_id===NULL)
		{
			echo '<script>window.history.back()</script>';
			return;
		}

		$data['product_id'] = $product_id;
		$product = $this->db->get_where('products',array('Product_ID'=>$product_id))->row();

		$nav_arr = $this->session->userdata('nav');

		if(isset($nav_arr['nav_1']))
		{
			$data['nav_1'] = $nav_arr['nav_1'];

			if(isset($nav_arr['nav_2']))
			{
				$data['nav_2'] = $nav_arr['nav_2'];
				$data['nav_3'] = array('name'=>$product->Pro_Name_En, 'link'=>site_url(), 'current'=>TRUE);
			}
			else
			{
				$data['nav_2'] = array('name'=>$product->Pro_Name_En, 'link'=>site_url(), 'current'=>TRUE);
			}
		}
		else
		{
			$data['nav_1'] = array('name'=>$product->Pro_Name_En, 'link'=>site_url(), 'current'=>TRUE);
		}

		$this->template->view('shops/item', $data);
	}

	function lang($lang=NULL)
	{
		$this->session->set_userdata('lang', $lang);
		redirect($this->session->userdata('prev_url'));
	}

	function _get_menu_url($level=NULL, $url=NULL)
	{
		if(LANG=='TH')
		{
			if($level==1)
			{
				if(isset($this->db->get_where('main_menu', array('main_url'=>$url))->row()->Name_Th))
				{
					return $this->db->get_where('main_menu', array('main_url'=>$url))->row()->Name_Th;
				}
			}
			elseif($level==2)
			{
				if(isset($this->db->get_where('sub_menu', array('sub_url'=>$url))->row()->Name_Th))
				{
					return $this->db->get_where('sub_menu', array('sub_url'=>$url))->row()->Name_Th;
				}
			}
			elseif($level==3)
			{
				if(isset($this->db->get_where('son_menu', array('son_url'=>$url))->row()->Name_Th))
				{
					return $this->db->get_where('son_menu', array('son_url'=>$url))->row()->Name_Th;
				}
			}
			elseif($level==4)
			{
				if(isset($this->db->get_where('thumb_menu', array('thumb_url'=>$url))->row()->Name_Th))
				{
					return $this->db->get_where('thumb_menu', array('thumb_url'=>$url))->row()->Name_Th;
				}
			}
			else
			{
				return $url;
			}
		}
		else
		{
			if($level==1)
			{
				if(isset($this->db->get_where('main_menu', array('main_url'=>$url))->row()->Name_En))
				{
					return $this->db->get_where('main_menu', array('main_url'=>$url))->row()->Name_En;
				}
			}
			elseif($level==2)
			{
				if(isset($this->db->get_where('sub_menu', array('sub_url'=>$url))->row()->Name_En))
				{
					return $this->db->get_where('sub_menu', array('sub_url'=>$url))->row()->Name_En;
				}
			}
			elseif($level==3)
			{
				if(isset($this->db->get_where('son_menu', array('son_url'=>$url))->row()->Name_En))
				{
					return $this->db->get_where('son_menu', array('son_url'=>$url))->row()->Name_En;
				}
			}
			elseif($level==4)
			{
				if(isset($this->db->get_where('thumb_menu', array('thumb_url'=>$url))->row()->Name_En))
				{
					return $this->db->get_where('thumb_menu', array('thumb_url'=>$url))->row()->Name_En;
				}
			}
			else
			{
				return $url;
			}
		}
	}

	function _get_product_url($url=NULL)
	{
		if(LANG=='TH')
		{
			$this->db->where('Group_Url_En', $url);
			$this->db->or_where('Group_Name_En', $url);
			return $this->db->get('product_groups')->row()->Group_Name_Th;
		}
		else
		{
			$this->db->where('Group_Url_En', $url);
			$this->db->or_where('Group_Name_En', $url);
			return $this->db->get('product_groups')->row()->Group_Name_En;
		}
	}

	function locator()
	{
		$data['nav_1'] = array('name'=>'Locator', 'link'=>site_url('checkout/locator'), 'current'=>TRUE);
		$this->template->view('shops/locator', $data);
	}

}

/* End of file shops.php */
/* Location: ./application/controllers/shops.php */
<?php
//-------------------------------------------------------------------------------------------------------------
//---------------------------------------------- Set DateTime -------------------------------------------------
//-------------------------------------------------------------------------------------------------------------
function set_date($originalDate)
{
	return date("M j, Y", strtotime($originalDate));
}
function set_dateTime($originalDate)
{
	return date("M j, Y h:i:s A", strtotime($originalDate));
}

//-------------------------------------------------------------------------------------------------------------
//-------------------------------------------------- Menu -----------------------------------------------------
//-------------------------------------------------------------------------------------------------------------
function get_menu()
{
	$ci =& get_instance();

	if(LANG==1)
	{
		$ci->db->order_by('menu_id', 'asc');
		$query = $ci->db->get('menu');
	}
	else
	{
		$ci->db->order_by('menu_id', 'asc');
		$ci->db->where('lang_id', LANG);
		$query = $ci->db->get('menu_lang');
	}

	return $query->result();
}

//-------------------------------------------------------------------------------------------------------------
//-------------------------------------------------- Login ----------------------------------------------------
//-------------------------------------------------------------------------------------------------------------
function get_login_user($username, $password)
{	
	$ci =& get_instance();
	$sql_login = "SELECT * FROM admins WHERE BINARY email='".$username."' AND BINARY password='".$password."'";

	return $ci->db->query($sql_login)->row();
}

function get_update_user($admin_id)
{
	$ci =& get_instance();
	$sql_user = "SELECT * FROM admins WHERE admin_id='".$admin_id."'";
	return $ci->db->query($sql_user)->row();
}

function get_user_lang($admin_id)
{
	$ci =& get_instance();
	$sql_user = "SELECT * FROM admins_lang WHERE admin_id='".$admin_id."' AND lang_id='".LANG."'";
	
	return $ci->db->query($sql_user)->row();
}

//-------------------------------------------------------------------------------------------------------------
//-------------------------------------------- Get name from DB -----------------------------------------------
//-------------------------------------------------------------------------------------------------------------
function get_city_name($city_id, $type)
{
	// type=1 -> choose language
	// type=2 -> default language for add to log_file
	$ci =& get_instance();

	if(LANG==1 OR $type==2)
	{
		$ci->db->select('name');
		$ci->db->from('city');
		$ci->db->where('city_id', $city_id);
	}
	else
	{
		$ci->db->select('name');
		$ci->db->from('city_lang');
		$ci->db->where('city_id', $city_id);
		$ci->db->where('lang_id', LANG);
	}
	return $ci->db->get()->row()->name;
}

function get_country_name($country_id, $type)
{
	// type=1 -> choose language
	// type=2 -> default language for add to log_file
	$ci =& get_instance();
	
	if(LANG==1 OR $type==2)
	{
		$ci->db->select('name');
		$ci->db->from('country');
		$ci->db->where('country_id', $country_id);
	}
	else
	{
		$ci->db->select('name');
		$ci->db->from('country_lang');
		$ci->db->where('country_id', $country_id);
		$ci->db->where('lang_id', LANG);
	}
	return $ci->db->get()->row()->name;
}

function get_position_name($position_id, $type)
{
	// type=1 -> choose language
	// type=2 -> default language for add to log_file
	$ci =& get_instance();

	if(LANG==1 OR $type==2)
	{
		$ci->db->select('name');
		$ci->db->from('positions');
		$ci->db->where('position_id', $position_id);
	}
	else
	{
		$ci->db->select('name');
		$ci->db->from('positions_lang');
		$ci->db->where('position_id', $position_id);
		$ci->db->where('lang_id', LANG);
	}
	return $ci->db->get()->row()->name;
}

function get_cat_name($cat_id)
{
	$ci =& get_instance();

	$ci->db->select('name');
	$ci->db->from('categories');
	$ci->db->where('cat_id', $cat_id);

	return $ci->db->get()->row()->name;
}
function get_cat_url_from_id($cat_id)
{
	$ci =& get_instance();

	$ci->db->select('url');
	$ci->db->from('categories');
	$ci->db->where('cat_id', $cat_id);

	return $ci->db->get()->row()->url;
}
function get_main_category_name($main_url)
{
	$ci =& get_instance();
		
	$ci->db->select('name');
	$ci->db->from('categories');
	$ci->db->where('url', $main_url);
		
	return $ci->db->get()->row()->name;
	
}
function get_attribute_name($attribute_id)
{
	
	$ci =& get_instance();
	
	$ci->db->select('name');
	$ci->db->from('attribute');
	$ci->db->where('attribute_id', $attribute_id);
		
	return $ci->db->get()->row()->name;
	
}

function get_property_name($prop_id)
{	
	$ci =& get_instance();
	
	$ci->db->select('name');
	$ci->db->from('property');
	$ci->db->where('prop_id' ,  $prop_id );
	
	return $ci->db->get()->row()->name;
} 
function get_color_name($color_id)
{
	$ci =& get_instance();
	
	$ci->db->select('name');
	$ci->db->from('color'); 
	$ci->db->where('color_id', $color_id);
		
	return $ci->db->get()->row()->name;
	
}
//------------------------------------------------------------------------------------------------------------
//-------------------------------------------- Select Dropdown -----------------------------------------------
//------------------------------------------------------------------------------------------------------------
function get_dropdown_city()
{
	$ci =& get_instance();
	
	if(LANG==1)
	{
		$ci->db->order_by('city_id', 'asc');
		$query = $ci->db->get('city');
	}
	else
	{
		$ci->db->order_by('city_id', 'asc');
		$ci->db->where('lang_id', LANG);
		$query = $ci->db->get('city_lang');
	}

	return $query->result();
}

function get_dropdown_country()
{
	$ci =& get_instance();
	
	if(LANG==1)
	{
		$ci->db->order_by('country_id', 'asc');
		$query = $ci->db->get('country');
	}
	else
	{
		$ci->db->order_by('country_id', 'asc');
		$ci->db->where('lang_id', LANG);
		$query = $ci->db->get('country_lang');
	}

	return $query->result();
}

function get_dropdown_positions()
{
	$ci =& get_instance();
	
	if(LANG==1)
	{
		$ci->db->order_by('position_id', 'asc');
		$query = $ci->db->get('positions');
	}
	else
	{
		$ci->db->order_by('position_id', 'asc');
		$ci->db->where('lang_id', LANG);
		$query = $ci->db->get('positions_lang');
	}

	return $query->result();
}

function get_dropdown_category_lv1()
{
	$ci =& get_instance();
	$ci->db->where('level', '1');
	$query = $ci->db->get('categories');

	return $query->result();
}

function get_dropdown_category_lv2($main_id)
{
	$ci =& get_instance();
	$ci->db->where('level', '2');
	$ci->db->where('main_id', $main_id);
	$query = $ci->db->get('categories');

	return $query->result();
}


//------------------------------------------------------------------------------------------------------------
//---------------------------------------------- dashboard -----------------------------------------------------
//------------------------------------------------------------------------------------------------------------

function dashboard_get_customer_list()
{
	$ci =& get_instance();
	$ci->db->select('cus_id , firstname , lastname , create_at');
	$ci->db->order_by('create_at' , 'desc');
	$ci->db->limit(5);
	if(LANG==1)
		$query = $ci->db->get('customers');
	else
	{
		$ci->db->where('lang_id',LANG);
		$query = $ci->db->get('customers_lang');
	}

	return $query->result();
}

function dashboard_get_product_list()
{	
	 $ci =& get_instance();
	 $ci->db->select('product_id, name, qty, prop_id, color_id');
	 $ci->db->order_by('qty' , 'asc');
	 $ci->db->limit(5);
	 $query = $ci->db->get('products');
	 return $query->result();
}

function dashboard_get_order_list()
{
	$ci =& get_instance();
	$ci->db->select('order_id , final_price , order_status , create_at');
	$ci->db->order_by('create_at' , 'desc');
	$ci->db->limit(5);
	$query = $ci->db->get('orders');
	return $query->result();
}

function dashboard_get_order_item()
{
	/*
	$ci =& get_instance();
	$ci->db->select('product_id , name');
	$ci->db->select_sum($select='qty',$alias='sumqty');
	$ci->db->group_by('product_id');
	$ci->db->order_by('qty', 'desc');
	$query = $ci->db->get('order_items');
	
	return $query->result();
	*/
	/*
	$ci =& get_instance();
	$arr = array('products.products_id' , 'products.name' , sum('order_items.qty'));
	$ci->db->select($arr);
	$ci->db->join('products', 'products.product_id = order_items.product_id');
	//$ci->db->group_by('product_id');
	//$ci->db->order_by('qty', 'desc');

	$query = $ci->db->get('order_items');
	
	return $query->result();
	*/
	
	$ci =& get_instance();
	$sql_bestSale = "SELECT order_items.product_id as order_items_product_id, order_items.name as order_items_name, SUM(order_items.qty) as order_items_sumqty, products.prop_id as products_prop_id, products.color_id as products_color_id
					FROM order_items JOIN products ON order_items.product_id=products.product_id 
					GROUP BY order_items.product_id
					ORDER BY order_items_sumqty DESC
					LIMIT 0, 5";
	return $ci->db->query($sql_bestSale)->result();
	
	////////////////////////
	/*
	SELECT product_id, SUM(qty) 
FROM order_items 
GROUP BY product_id
ORDER BY qty DESC
*/
	////////////////////////
	
	
}

//------------------------------------------------------------------------------------------------------------
//------------------------------------------------- Admin ----------------------------------------------------
//------------------------------------------------------------------------------------------------------------
function get_select_admin($admin_id)
{
	$ci =& get_instance();
	$sql_admin = "SELECT * FROM admins WHERE admin_id='".$admin_id."'";
	return $ci->db->query($sql_admin)->row();
}

function get_select_admin_array($admin_id)
{
	$ci =& get_instance();
	$sql_admin = "SELECT * FROM admins WHERE admin_id='".$admin_id."'";
	return $ci->db->query($sql_admin)->row_array();
}

function get_admin_list()
{
	$ci =& get_instance();

	if(LANG==1)
		$query = $ci->db->get('admins');
	else
	{
		$ci->db->where('lang_id',LANG);
		$query = $ci->db->get('admins_lang');
	}
	return $query->result();
}


//------------------------------------------------------------------------------------------------------------
//----------------------------------------------- Customer ---------------------------------------------------
//------------------------------------------------------------------------------------------------------------
function get_customer_list()
{
	$ci =& get_instance();
	$ci->db->order_by('cus_id');
	if(LANG==1)
		$query = $ci->db->get('customers');
	else
	{
		$ci->db->where('lang_id',LANG);
		$query = $ci->db->get('customers_lang');
	}

	return $query->result();
}

function get_select_customer($cus_id)
{
	$ci =& get_instance();
	
	if(LANG==1)
		$sql_customer = "SELECT * FROM customers WHERE cus_id='".$cus_id."'";
	else
		$sql_customer = "SELECT * FROM customers_lang WHERE lang_id='".LANG."' AND cus_id='".$cus_id."'";

	return $ci->db->query($sql_customer)->row();
}

function get_select_customer_array($cus_id)
{
	$ci =& get_instance();
	
	if(LANG==1)
		$sql_customer = "SELECT * FROM customers WHERE cus_id='".$cus_id."'";
	else
		$sql_customer = "SELECT * FROM customers_lang WHERE lang_id='".LANG."' AND cus_id='".$cus_id."'";

	return $ci->db->query($sql_customer)->row_array();
}

function get_select_customer_address($cus_id)
{
	$ci =& get_instance();
	
	if(LANG==1)
		$sql_customer = "SELECT * FROM cus_address WHERE cus_id='".$cus_id."'";
	else
		$sql_customer = "SELECT * FROM cus_address_lang WHERE lang_id='".LANG."' AND cus_id='".$cus_id."'";

	return $ci->db->query($sql_customer)->row();
}

function get_select_customer_address_array($cus_id)
{
	$ci =& get_instance();
	
	if(LANG==1)
		$sql_customer = "SELECT * FROM cus_address WHERE cus_id='".$cus_id."'";
	else
		$sql_customer = "SELECT * FROM cus_address_lang WHERE lang_id='".LANG."' AND cus_id='".$cus_id."'";

	return $ci->db->query($sql_customer)->row_array();
}

function get_select_billing_address($cus_id)
{
	$ci =& get_instance();
	
	if(LANG==1)
		$sql_customer = "SELECT cus_id, b_firstname, b_lastname, b_address, b_city_id, b_postcode, b_country_id, b_phone FROM cus_address WHERE cus_id='".$cus_id."'";
	else
		$sql_customer = "SELECT cus_id, b_firstname, b_lastname, b_address, b_city_id, b_postcode, b_country_id, b_phone FROM cus_address_lang WHERE lang_id='".LANG."' AND cus_id='".$cus_id."'";

	return $ci->db->query($sql_customer)->row_array();
}

function get_select_shipping_address($cus_id)
{
	$ci =& get_instance();
	
	if(LANG==1)
		$sql_customer = "SELECT cus_id, s_firstname, s_lastname, s_address, s_city_id, s_postcode, s_country_id, s_phone FROM cus_address WHERE cus_id='".$cus_id."'";
	else
		$sql_customer = "SELECT cus_id, s_firstname, s_lastname, s_address, s_city_id, s_postcode, s_country_id, s_phone FROM cus_address_lang WHERE lang_id='".LANG."' AND cus_id='".$cus_id."'";

	return $ci->db->query($sql_customer)->row_array();
}

//------------------------------------------------------------------------------------------------------------
//-------------------------------------------- Customer Group ------------------------------------------------
//------------------------------------------------------------------------------------------------------------
function get_cusgroup_list()
{
	$ci =& get_instance();
	if(LANG==1)
		$query = $ci->db->get('cus_group');
	else
	{
		$ci->db->where('lang_id',LANG);
		$query = $ci->db->get('cus_group_lang');
	}

	return $query->result();
}

function get_cusgroup_fromName($name)
{
	$ci =& get_instance();
	$sql_cusgroup = "SELECT * FROM cus_group WHERE name='".$name."'";
	return $ci->db->query($sql_cusgroup)->row();
}

function get_cusgroup_fromName_array($name)
{
	$ci =& get_instance();
	$sql_cusgroup = "SELECT * FROM cus_group WHERE name='".$name."'";
	return $ci->db->query($sql_cusgroup)->row_array();
}

function get_group_member_list($cusgroup_id)
{
	$ci =& get_instance();
	$ci->db->where('cusgroup_id', $cusgroup_id);
	$ci->db->join('customers', 'cus_group_list.cus_id = customers.cus_id');
	$query = $ci->db->get('cus_group_list');

	return $query->result();
}

function check_name_cus_group($name)
{
	$ci =& get_instance();

	$query = $ci->db->get_where('cus_group', array('name'=>$name))->row();
	if(!empty($query))
	{
		return TRUE;
	}
	else
	{
		return FALSE;
	}
}
function check_edit_name_cus_group($cusgroup_id, $name)
{
	$ci =& get_instance();

	$ci->db->where('cusgroup_id !=', $cusgroup_id);
	$query = $ci->db->get_where('cus_group', array('name'=>$name))->row();
	if(!empty($query))
	{
		return TRUE;
	}
	else
	{
		return FALSE;
	}
}

function check_in_group($cus_id=NULL, $cusgroup_id=NULL)
{
	$ci =& get_instance();
	$query = $ci->db->get_where('cus_group_list', array('cus_id'=>$cus_id, 'cusgroup_id'=>$cusgroup_id))->row();
	if(!empty($query))
	{
		return TRUE;
	}
	else
	{
		return FALSE;
	}
}

//------------------------------------------------------------------------------------------------------------
//---------------------------------------------- Categories --------------------------------------------------
//------------------------------------------------------------------------------------------------------------
function get_select_category($cat_id)
{
	$ci =& get_instance();
	$sql_cat = "SELECT * FROM categories WHERE cat_id='".$cat_id."'";
	return $ci->db->query($sql_cat)->row();
}

function get_select_category_array_from_url($cat_url)
{
	$ci =& get_instance();
	$sql_cat = "SELECT * FROM categories WHERE url='".$cat_url."'";
	return $ci->db->query($sql_cat)->row_array();
}


function get_category_main_list()
{
	$ci =& get_instance();

	$ci->db->where('level','1');
	$query = $ci->db->get('categories');

	return $query->result();
}
function get_category_sub_list($main_id)
{
	$ci =& get_instance();

	$ci->db->where('level','2');
	$ci->db->where('main_id',$main_id);
	$query = $ci->db->get('categories');

	return $query->result();
}

function get_category_sub_list_from_name($main_url)
{
	$ci =& get_instance();
	
	$ci->db->select('cat_id');
	$ci->db->from('categories');
	$ci->db->where('url', $main_url);	
	$main_id = $ci->db->get()->row()->cat_id;
	
	
	$ci->db->where('level','2');
	$ci->db->where('main_id',$main_id);
	//$ci->db->where('main_id' $cat_id);
	$query = $ci->db->get('categories');
	
	return $query->result();
}

function get_category_sub2_list($sub_id)
{
	$ci =& get_instance();

	$ci->db->where('level','3');
	$ci->db->where('sub_id',$sub_id);
	$query = $ci->db->get('categories');

	return $query->result();
}
function get_category_sub2_list_from_name($sub_url)
{
	$ci =& get_instance();
	
	$ci->db->select('cat_id');
	$ci->db->from('categories');
	$ci->db->where('url' , $sub_url);
	$sub_id = $ci->db->get()->row()->cat_id;
		
	$ci->db->where('level' , '3');
	$ci->db->where('sub_id' , $sub_id );
	$query = $ci->db->get('categories');
	
	return $query->result();
	
}

function check_url_category($url)
{
	$ci =& get_instance();

	$query = $ci->db->get_where('categories', array('url'=>$url))->row();
	if(!empty($query))
	{
		return TRUE;
	}
	else
	{
		return FALSE;
	}
}
function get_cat_id()
{
	$ci =& get_instance();

	$ci->db->select('cat_id');
	$ci->db->order_by('cat_id', 'desc');
	$query = $ci->db->get('categories')->row();
	return $query->cat_id;
}

//---- get last rank ----
function get_last_rank_lv1()
{
	$ci =& get_instance();

	$ci->db->select('rank');
	$ci->db->where('level', '1');
	$ci->db->order_by('rank', 'desc');
	$query = $ci->db->get('categories')->row();
	if(!empty($query))
	{
		return $query->rank + 1;
	}
	else
		return '1';
}
function get_last_rank_lv2($cat_id_lv1)
{
	$ci =& get_instance();

	$ci->db->select('rank');
	$ci->db->where('level', '2');
	$ci->db->where('main_id', $cat_id_lv1);
	$ci->db->order_by('rank', 'desc');
	$query = $ci->db->get('categories')->row();
	if(!empty($query))
	{
		return $query->rank + 1;
	}
	else
		return '1';
}
function get_last_rank_lv3($cat_id_lv2)
{
	$ci =& get_instance();

	$ci->db->select('rank');
	$ci->db->where('level', '3');
	$ci->db->where('sub_id', $cat_id_lv2);
	$ci->db->order_by('rank', 'desc');
	$query = $ci->db->get('categories')->row();
	if(!empty($query))
	{
		return $query->rank + 1;
	}
	else
		return '1';
}
//---- end get last rank ----

//------------------------------------------------------------------------------------------------------------
//---------------------------------------------- Products Group ----------------------------------------------
//------------------------------------------------------------------------------------------------------------

function get_pro_group_list()
{
	$ci =& get_instance();
	$ci->db->order_by('progroup_id');
	$query = $ci->db->get('pro_group');
	return $query->result();

}

function get_select_product_group($url)
{
	$ci =& get_instance();
	
	$sql_group = "SELECT * FROM pro_group  WHERE url='".$url."'";
	return $ci->db->query($sql_group)->row();
}
function get_select_product_group_array($url)
{
	$ci =& get_instance();
	
	$sql_group = "SELECT * FROM pro_group  WHERE url='".$url."'";
	return $ci->db->query($sql_group)->row_array();
}

function get_primary_img_group($progroup_id)
{
	$ci =& get_instance();

	$ci->db->select('path');
	$ci->db->from('products');
	$ci->db->join('product_img', 'products.product_id = product_img.product_id');
	$ci->db->where('products.progroup_id', $progroup_id);
	$ci->db->where('products.primary', '1');
	$ci->db->where('product_img.primary', '1');
	$query = $ci->db->get()->row();

	if(!empty($query))
		return $query->path;
	else
		return '';
}

//---- check same data ----
function check_id_pro_group($progroup_id)
{
	$ci =& get_instance();

	$query = $ci->db->get_where('pro_group', array('progroup_id'=>$progroup_id))->row();
	if(!empty($query))
	{
		return TRUE;
	}
	else
	{
		return FALSE;
	}
}
function check_edit_id_pro_group($select_id, $progroup_id)
{
	$ci =& get_instance();

	$ci->db->where('progroup_id !=', $select_id);
	$query = $ci->db->get_where('pro_group', array('progroup_id'=>$progroup_id))->row();
	if(!empty($query))
	{
		return TRUE;
	}
	else
	{
		return FALSE;
	}
}

function check_name_pro_group($name)
{
	$ci =& get_instance();

	$query = $ci->db->get_where('pro_group', array('name'=>$name))->row()->name;
	if($name == $query)
	{
		$this->form_validation->set_message('check_name_pro_group' , 'The %s is already used');
		return FALSE;
	}
	else
	{
		return TRUE;
	}
}
function check_edit_name_pro_group($select_id, $name)
{
	$ci =& get_instance();

	$ci->db->where('progroup_id !=', $select_id);
	$query = $ci->db->get_where('pro_group', array('name'=>$name))->row();
	if(!empty($query))
	{
		return TRUE;
	}
	else
	{
		return FALSE;
	}
}

function check_url_pro_group($url)
{
	$ci =& get_instance();

	$query = $ci->db->get_where('pro_group', array('url'=>$url))->row();
	if(!empty($query))
	{
		return TRUE;
	}
	else
	{
		return FALSE;
	}
}
function check_edit_url_pro_group($select_id, $url)
{
	$ci =& get_instance();

	$ci->db->where('progroup_id !=', $select_id);
	$query = $ci->db->get_where('pro_group', array('url'=>$url))->row();
	if(!empty($query))
	{
		return TRUE;
	}
	else
	{
		return FALSE;
	}
}

//---- get last rank product ----
function get_last_rank_pro_group()
{
	$ci =& get_instance();

	$ci->db->select('rank');
	$ci->db->order_by('rank', 'desc');
	$query = $ci->db->get('pro_group')->row();
	if(!empty($query))
	{
		return $query->rank + 1;
	}
	else
		return '1';
}

//---- get keword group list selected ----
function get_keygroup_list_edit_select($progroup_id)
{
	$ci =& get_instance();
	
	$ci->db->order_by('keygroup.name');
	$ci->db->where('progroup_id', $progroup_id);
	$ci->db->join('keygroup', 'keygroup.keygroup_id = keygroup_list.keygroup_id');
	$query = $ci->db->get('keygroup_list');
	
	return $query->result();
}
function get_keygroup_list_edit_no_select($progroup_id)
{
	$ci =& get_instance();
	
	$ci->db->order_by('name');
	foreach(get_keygroup_list_edit_select($progroup_id) as $value)
	{
		$ci->db->where("keygroup.keygroup_id !=", $value->keygroup_id);
	}
	$query = $ci->db->get('keygroup');
	
	return $query->result();
}
function get_pro_group_name($select_id)
{
	$ci =& get_instance();
	
	$ci->db->select('name')->where('progroup_id' , $select_id );
	return $ci->db->get('pro_group')->row()->name ; 
}
function get_pro_group_url($select_id)
{
	$ci =& get_instance();
	
	$ci->db->select('url')->where('progroup_id' , $select_id );
	return $ci->db->get('pro_group')->row()->url ; 
}

//------------------------------------------------------------------------------------------------------------
//---------------------------------------------- Products ----------------------------------------------------
//------------------------------------------------------------------------------------------------------------

function get_product_list()
{	
	 $ci =& get_instance();
	 $ci->db->order_by('product_id');
	 $query = $ci->db->get('products');
	 return $query->result();
}
function get_product_list_by_rank()
{
	 $ci =& get_instance();
	 $ci->db->order_by('rank');
	 $query = $ci->db->get('products');
	 return $query->result();
}

function get_select_product($product_id)
{
	$ci =& get_instance();
	
	$sql_product = "SELECT * FROM products  WHERE product_id='".$product_id."'";
	return $ci->db->query($sql_product)->row();
}
function get_select_product_array($product_id)
{
	$ci =& get_instance();
	
	$sql_product = "SELECT * FROM products  WHERE product_id='".$product_id."'";
	return $ci->db->query($sql_product)->row_array();
}

function get_product_from_group_name($url)
{
	$ci =& get_instance();
	$ci->db->select('progroup_id');
	$ci->db->from('pro_group');
	$ci->db->where('url' , $url);
	$progroup_id = $ci->db->get()->row()->progroup_id;
	
	//$ci->db->select('name');
	//$ci->db->from('pro_group');
	$ci->db->where('progroup_id' , $progroup_id);
	$query = $ci->db->get('products');
	
	return $query->result();	
}	

function check_name_product($name)
{
	$ci =& get_instance();

	$query = $ci->db->get_where('products', array('name'=>$name))->row();
	if(!empty($query))
	{
		return TRUE;
	}
	else
	{
		return FALSE;
	}
}
function check_edit_name_product($product_id, $name)
{
	$ci =& get_instance();

	$ci->db->where('product_id !=', $product_id);
	$query = $ci->db->get_where('products', array('name'=>$name))->row();
	if(!empty($query))
	{
		return TRUE;
	}
	else
	{
		return FALSE;
	}
}

function get_next_product_id()
{
	$ci =& get_instance();
	
	$ci->db->select('product_id');
	$ci->db->order_by('product_id', 'desc');
	$query = $ci->db->get('products')->row();
	
	if(!empty($query))
	{	
		$product_id = $query->product_id;
		$product_id = substr($product_id, 1);
		$product_id = "P".sprintf("%06d", $product_id+1);
		
		return $product_id;
	}
	else
		$product_id = "P000001";
		
	return $product_id;
}
function get_next_rank_product($progroup_id)
{
	$ci =& get_instance();

	$ci->db->select('rank');
	$ci->db->order_by('rank', 'desc');
	$ci->db->where('progroup_id', $progroup_id);
	$query = $ci->db->get('products')->row();
	if(!empty($query))
	{
		return $query->rank + 1;
	}
	else
		return '1';
}

function get_primary_img_from_id($product_id)
{
	$ci =& get_instance();
	
	$ci->db->select('path');
	$ci->db->where('product_id' , $product_id );
	$ci->db->where('primary' , '1');
	$query = $ci->db->get('product_img')->row();
	if(!empty($query))
		return $query->path;
	else
		return '';
}

function get_product_img_from_id($product_id)
{
	$ci =& get_instance();
	
	$ci->db->where('product_id' , $product_id );
	$query = $ci->db->get('product_img');
	
	return $query->result();
}
function get_path_select_product_img($image_id)
{	
	$ci =& get_instance();
	$sql_img = "SELECT path FROM product_img WHERE id='".$image_id."'";
	return $ci->db->query($sql_img)->row()->path;
}

//---- prouct images ----
function get_last_rank_product_img($product_id)
{
	$ci =& get_instance();

	$ci->db->select('rank');
	$ci->db->order_by('rank', 'desc');
	$ci->db->where('product_id', $product_id);
	$query = $ci->db->get('product_img')->row();
	if(!empty($query))
	{
		return $query->rank + 1;
	}
	else
		return '1';
}

//---- get keword list selected ----
function get_keyword_list_edit_select($product_id)
{
	$ci =& get_instance();
	
	$ci->db->order_by('keyword.name');
	$ci->db->where('product_id', $product_id);
	$ci->db->join('keyword', 'keyword.keyword_id = keyword_list.keyword_id');
	$query = $ci->db->get('keyword_list');
	
	return $query->result();
}
function get_keyword_list_edit_no_select($product_id)
{
	$ci =& get_instance();
	
	$ci->db->order_by('name');
	foreach(get_keyword_list_edit_select($product_id) as $value)
	{
		$ci->db->where("keyword.keyword_id !=", $value->keyword_id);
	}
	$query = $ci->db->get('keyword');
	
	return $query->result();
}

//-------- remove -------
	//---- product group ----
	function product_group_remove_rank($progroup_id)
	{
		$ci =& get_instance();

		$ci->db->select('rank');
		$ci->db->where('progroup_id', $progroup_id);
		$query = $ci->db->get('pro_group')->row();

		if(!empty($query))
		{
			$ci->db->select('progroup_id, rank');
			$ci->db->where('rank >' , $query->rank );
			$query = $ci->db->get('pro_group');
			
			return $query->result();
		}
	}
	//---- product ----
	function product_remove_rank($product_id)
	{
		$ci =& get_instance();

		$ci->db->select('rank, progroup_id');
		$ci->db->where('product_id', $product_id);
		$query = $ci->db->get('products')->row();

		if(!empty($query))
		{
			$ci->db->select('product_id, rank');
			$ci->db->where('progroup_id' , $query->progroup_id );
			$ci->db->where('rank >' , $query->rank );
			$query = $ci->db->get('products');
			
			return $query->result();
		}
	}
	//---- product images ----
	function product_image_remove_rank($image_id, $product_id)
	{
		$ci =& get_instance();

		$ci->db->select('rank');
		$ci->db->where('id', $image_id);
		$query = $ci->db->get('product_img')->row();

		if(!empty($query))
		{
			$ci->db->select('id, rank');
			$ci->db->where('product_id', $product_id);
			$ci->db->where('rank >' , $query->rank );
			$query = $ci->db->get('product_img');
			
			return $query->result();
		}
	}


//------------------------------------------------------------------------------------------------------------
//---------------------------------------------- Colors ------------------------------------------------------
//------------------------------------------------------------------------------------------------------------

function get_color_list()
{	
	 $ci =& get_instance();
	 $ci->db->order_by('rank');
	 $query = $ci->db->get('color');
	 return $query->result();
	
}

function get_last_rank_color()
{
	$ci =& get_instance();

	$ci->db->select('rank');
	$ci->db->order_by('rank', 'desc');
	$query = $ci->db->get('color')->row();
	if(!empty($query))
	{
		return $query->rank + 1;
	}
	else
		return '1';
}

function get_select_color($color_id)
{
	$ci =& get_instance();
	$sql_color = "SELECT * FROM color WHERE color_id='".$color_id."'";
	return $ci->db->query($sql_color)->row();
}

function get_select_color_array($name)
{
	$ci =& get_instance();
	$sql_color = "SELECT * FROM color WHERE name='".$name."'";
	return $ci->db->query($sql_color)->row_array();
}


//------------------------------------------------------------------------------------------------------------
//---------------------------------------------- Properties --------------------------------------------------
//------------------------------------------------------------------------------------------------------------

function get_property_list()
{	
	 $ci =& get_instance();
	 $ci->db->order_by('rank');
	 $query = $ci->db->get('property');
	 return $query->result();
	
}

function get_last_rank_property()
{
	$ci =& get_instance();

	$ci->db->select('rank');
	$ci->db->order_by('rank', 'desc');
	$query = $ci->db->get('property')->row();
	if(!empty($query))
	{
		return $query->rank + 1;
	}
	else
		return '1';
}
function get_select_property($prop_id)
{
	$ci =& get_instance();
	$sql_property = "SELECT * FROM property WHERE prop_id='".$prop_id."'";
	return $ci->db->query($sql_property)->row();
}

function get_select_property_array($name)
{
	$ci =& get_instance();
	$sql_property = "SELECT * FROM property WHERE name='".$name."'";
	return $ci->db->query($sql_property)->row_array();
}



//------------------------------------------------------------------------------------------------------------
//---------------------------------------------- Attributes---------------------------------------------------
//------------------------------------------------------------------------------------------------------------

function get_attribute_list()
{	
	 $ci =& get_instance();
	 $ci->db->order_by('attribute_id');
	 $query = $ci->db->get('attribute');
	 return $query->result();
	
}
function get_select_attribute_array($name)
{
	$ci =& get_instance();
	$sql_keyword = "SELECT * FROM attribute WHERE name='".$name."'";
	return $ci->db->query($sql_keyword)->row_array();
}

function get_select_attribute_name($attribute_id)
{
	$ci =& get_instance();
	$sql_attribute = "SELECT name FROM attribute WHERE attribute_id='".$attribute_id."'";
	return $ci->db->query($sql_attribute)->row()->name;
}

//------------------------------------------------------------------------------------------------------------
//---------------------------------------------- Keywords-----------------------------------------------------
//------------------------------------------------------------------------------------------------------------

function get_keyword_list()
{	
	 $ci =& get_instance();
	 $ci->db->order_by('name');
	 $query = $ci->db->get('keyword');
	 return $query->result();
}
function get_select_keyword_array($name)
{
	$ci =& get_instance();
	$sql_keyword = "SELECT * FROM keyword WHERE name='".$name."'";
	return $ci->db->query($sql_keyword)->row_array();
}
function get_select_keyword_name($keyword_id)
{
	$ci =& get_instance();
	$sql_keyword = "SELECT name FROM keyword WHERE keyword_id='".$keyword_id."'";
	return $ci->db->query($sql_keyword)->row()->name;
}



//------------------------------------------------------------------------------------------------------------
//------------------------------------------ Keyword Group ---------------------------------------------------
//------------------------------------------------------------------------------------------------------------

function get_keygroup_list()
{	
	 $ci =& get_instance();
	 $ci->db->order_by('name');
	 $query = $ci->db->get('keygroup');
	 return $query->result();
}


function get_select_keyword_group_array($name)
{
	$ci =& get_instance();
	$sql_keyword = "SELECT * FROM keygroup WHERE name='".$name."'";
	return $ci->db->query($sql_keyword)->row_array();
}
function get_select_keyword_group_name($keygroup_id)
{
	$ci =& get_instance();
	$sql = "SELECT name FROM keygroup WHERE keygroup_id='".$keygroup_id."'";
	return $ci->db->query($sql)->row()->name;
}

//------------------------------------------------------------------------------------------------------------
//----------------------------------------------- Shipping ---------------------------------------------------
//------------------------------------------------------------------------------------------------------------
function get_shipping_list()
{
	$ci =& get_instance();
	$ci->db->order_by('shipping_id');
	if(LANG==1)
		$query = $ci->db->get('shipping');
	else
	{
		$ci->db->where('lang_id',LANG);
		$query = $ci->db->get('shipping_lang');
	}

	return $query->result();
}
function get_shipping_id()
{
	$ci =& get_instance();

	$ci->db->select('shipping_id');
	$ci->db->order_by('shipping_id', 'desc');
	$query = $ci->db->get('shipping')->row();
	return $query->shipping_id;
}

function get_select_shipping($shipping_id)
{
	$ci =& get_instance();
	
	$sql_shipping = "SELECT * FROM shipping  WHERE shipping_id='".$shipping_id."'";
	return $ci->db->query($sql_shipping)->row();
}
function get_shipping_range_from_id($shipping_id)
{
	$ci =& get_instance();
	
	$ci->db->where('shipping_id' , $shipping_id );
	$query = $ci->db->get('shipping_range');
	
	return $query->result();
}
function get_shipping_range_id()
{
	$ci =& get_instance();

	$ci->db->select('range_id');
	$ci->db->order_by('range_id', 'desc');
	$query = $ci->db->get('shipping_range')->row();
	return $query->range_id;
}
function get_select_shipping_array($shipping_id)
{
	$ci =& get_instance();
	$sql_shipping = "SELECT * FROM shipping WHERE shipping_id='".$shipping_id."'";
	return $ci->db->query($sql_shipping)->row_array();
}

function get_select_shipping_range_array($range_id)
{
	$ci =& get_instance();
	$sql_shipping_range = "SELECT * FROM shipping_range WHERE range_id='".$range_id."'";
	return $ci->db->query($sql_shipping_range)->row_array();
}

function get_shipping_id_from_range($range_id)
{
	$ci =& get_instance();
	$ci->db->select('shipping_id');
	$ci->db->where('range_id' , $range_id);
	$query = $ci->db->get('shipping_range')->row();
	return $query->shipping_id;
	
}
function get_select_shipping_range($range_id)
{
	$ci =& get_instance();
	$sql_shipping_range = "SELECT * FROM shipping_range WHERE range_id='".$range_id."'";


	return $ci->db->query($sql_shipping_range)->row();
}
function get_select_shipping_name($shipping_id)
{
	$ci =& get_instance();
	$ci->db->select('name');
	$ci->db->where('shipping_id' , $shipping_id);
	$query = $ci->db->get('shipping')->row();

	return $query->name ;
}
function get_shipping_name($shipping_id)
{
	$ci =& get_instance();
	$sql_shipping = "SELECT name FROM shipping WHERE shipping_id='".$shipping_id."'";
	return $ci->db->query($sql_shipping)->row()->name;
}



//------------------------------------------------------------------------------------------------------------
//---------------------------------------------- Payment -----------------------------------------------------
//------------------------------------------------------------------------------------------------------------

function get_payment_list()
{
	$ci =& get_instance();
	$ci->db->order_by('name');
	if(LANG==1)
		$query = $ci->db->get('payment');
	else
	{
		$ci->db->where('lang_id',LANG);
		$query = $ci->db->get('payment_lang');
	}

	return $query->result();
}

function get_last_payment_id()
{
	$ci =& get_instance();

	$ci->db->select('payment_id');
	$ci->db->order_by('payment_id', 'desc');
	$query = $ci->db->get('payment')->row();

	return $query->payment_id;
}
function get_select_payment_array($payment_id)
{
	$ci =& get_instance();
	$sql_payment = "SELECT * FROM payment WHERE payment_id='".$payment_id."'";
	return $ci->db->query($sql_payment)->row_array();
}
function get_select_payment($payment_id)
{
	$ci =& get_instance();
	
	$sql_payment = "SELECT * FROM payment WHERE payment_id='".$payment_id."'";
	return $ci->db->query($sql_payment)->row();
}
function get_payment_name($payment_id)
{
	$ci =& get_instance();
	$sql_payment = "SELECT name FROM payment WHERE payment_id='".$payment_id."'";
	return $ci->db->query($sql_payment)->row()->name;
}


//------------------------------------------------------------------------------------------------------------
//---------------------------------------------- Coupon -----------------------------------------------------
//------------------------------------------------------------------------------------------------------------

function get_coupon_from_code($coupon_code)
{
	$ci =& get_instance();
	$sql_coupon = "SELECT * FROM coupon WHERE coupon_code='".$coupon_code."'";
	return $ci->db->query($sql_coupon)->row();
}

function check_coupon_can_use($coupon_code)
{
	$ci =& get_instance();
	$ci->db->select('start_date, end_date, coupon_status');
	$ci->db->where('coupon_code', $coupon_code);
	$ci->db->from('coupon');
	$coupon_detail = $ci->db->get()->row();
	if(!empty($coupon_detail))
	{
		$coupon_status = $coupon_detail->coupon_status;
		$start_date = $coupon_detail->start_date;
		$end_date = $coupon_detail->end_date;
		
		$now = date("Y-m-d");
		if($coupon_status!=1 OR $now<=$start_date OR $end_date<=$now)
			return FALSE;
		else
			return TRUE;
	}
	else
		return FALSE;
}

//------------------------------------------------------------------------------------------------------------
//---------------------------------------------- Orders ------------------------------------------------------
//------------------------------------------------------------------------------------------------------------

function get_order_list()
{
	$ci =& get_instance();
	$ci->db->order_by('create_at' , 'desc');
	$query = $ci->db->get('orders');
	return $query->result();
}

function get_order_status_from_order_id($order_id)
{
	$ci =& get_instance();
	$sql_order = "SELECT order_id, order_status, shipping_number FROM orders WHERE order_id='".$order_id."'";
	
	return $ci->db->query($sql_order)->row();
}

function get_bill_name_from_order_id($order_id)
{
	$ci =& get_instance();
	
	$ci->db->select('b_firstname , b_lastname');
	$ci->db->from('order_address');
	$ci->db->where('order_id' , $order_id);
	
	$query = $ci->db->get()->row();
	return $query->b_firstname." ".$query->b_lastname;
	
}

function get_ship_name_from_order_id($order_id)
{
	$ci =& get_instance();
	
	$ci->db->select('s_firstname , s_lastname');
	$ci->db->from('order_address');
	$ci->db->where('order_id' , $order_id);
	
	$query = $ci->db->get()->row();
	return $query->s_firstname." ".$query->s_lastname;
}

/*function get_select_order($order_id)
{
	$ci =& get_instance();
	
	$ci->db->where('order_id' , $order_id);
	$query = $ci-db->get('orders');
	return $query->result();
}
*/

function get_select_order_address($order_id)
{
	$ci =& get_instance();
	$sql_order = "SELECT * FROM order_address WHERE order_id='".$order_id."'";
	
	return $ci->db->query($sql_order)->row();
}
function get_select_order_address_array($order_id)
{
	$ci =& get_instance();
	$sql_order = "SELECT * FROM order_address WHERE order_id='".$order_id."'";
	
	return $ci->db->query($sql_order)->row_array();
}

function get_shipping_id_and_name_array($order_id)
{
	$ci =& get_instance();
	$sql_order = "SELECT orders.shipping_id, shipping.name FROM orders JOIN shipping ON orders.shipping_id=shipping.shipping_id WHERE order_id='".$order_id."'";
	
	return $ci->db->query($sql_order)->row_array();
}

function get_payment_id_and_name($order_id)
{
	$ci =& get_instance();
	$sql_order = "SELECT orders.payment_id, payment.name FROM orders JOIN payment ON orders.payment_id=payment.payment_id WHERE order_id='".$order_id."'";
	
	return $ci->db->query($sql_order)->row();
}
function get_payment_id_and_name_array($order_id)
{
	$ci =& get_instance();
	$sql_order = "SELECT orders.payment_id, payment.name FROM orders JOIN payment ON orders.payment_id=payment.payment_id WHERE order_id='".$order_id."'";
	
	return $ci->db->query($sql_order)->row_array();
}

function get_select_order($order_id)
{
	$ci =& get_instance();
	$sql_order = "SELECT orders.order_id, orders.cus_id, orders.price, orders.discount_price, orders.coupon_code, orders.discount_coupon, orders.total_price, orders.total_weight, orders.shipping_id, orders.shipping_price, orders.final_price, orders.payment_id, orders.order_status, orders.shipping_number, orders.create_at, log_orders.update_at AS order_update_at, log_orders.update_by AS order_update_by, log_order_address.update_at AS address_update_at, log_order_address.update_by AS address_update_by
				FROM orders JOIN log_orders ON orders.order_id = log_orders.order_id
				JOIN log_order_address ON orders.order_id = log_order_address.order_id
				WHERE orders.order_id='".$order_id."'
				ORDER BY log_orders.update_at DESC, log_order_address.update_at DESC
				LIMIT 1";
	
	return $ci->db->query($sql_order)->row();
}
function get_select_order_array($order_id)
{
	$ci =& get_instance();
	$sql_order = "SELECT orders.order_id, orders.cus_id, orders.price, orders.discount_price, orders.coupon_code, orders.discount_coupon, orders.total_price, orders.total_weight, orders.shipping_id, orders.shipping_price, orders.final_price, orders.payment_id, orders.order_status, orders.shipping_number, orders.create_at, log_orders.update_at AS order_update_at, log_orders.update_by AS order_update_by, log_order_address.update_at AS address_update_at, log_order_address.update_by AS address_update_by
				FROM orders JOIN log_orders ON orders.order_id = log_orders.order_id
				JOIN log_order_address ON orders.order_id = log_order_address.order_id
				WHERE orders.order_id='".$order_id."'
				ORDER BY log_orders.update_at DESC, log_order_address.update_at DESC
				LIMIT 1";
	
	return $ci->db->query($sql_order)->row_array();
}

function get_order_from_id($order_id)
{
	$ci =& get_instance();
	$sql_order = "SELECT * FROM orders WHERE order_id='".$order_id."'";
	return $ci->db->query($sql_order)->row();
}

function get_order_item_from_id($order_id)
{
	$ci =& get_instance();
	$sql_order = "SELECT * FROM order_items WHERE order_id='".$order_id."'";
	
	return $ci->db->query($sql_order)->result();
}
function get_edit_order_item_from_id($order_id)
{
	$ci =& get_instance();
	$ci->db->select('order_item_id, product_id, qty');
	$ci->db->where('order_id', $order_id);
	$query = $ci->db->get('order_items');
	return $query->result();
}

function get_order_item_detail($order_item_id)
{
	$ci =& get_instance();
	$sql_order_item = "SELECT * FROM order_items WHERE order_item_id='".$order_item_id."'";
	return $ci->db->query($sql_order_item)->row();
}

function check_order_product_qty($product_id, $order_qty)
{
	$ci =& get_instance();
	$ci->db->select('qty');
	$ci->db->from('products');
	$ci->db->where('product_id', $product_id);
	$product_qty = $ci->db->get()->row()->qty;
	
	if($order_qty > $product_qty)
		return FALSE;
	else
		return TRUE;
}

function check_shipping_method($shipping_id, $country_id)
{
	if($shipping_id == 0)
		return FALSE;
	else if($shipping_id==1 OR $shipping_id==2)
	{
		if($country_id!=222)
			return FALSE;
		else
			return TRUE;
	}
	else
		return TRUE;
}

function get_order_item_id($order_id)
{
	$ci =& get_instance();

	$ci->db->select('order_item_id');
	$ci->db->where('order_id', $order_id);
	$ci->db->order_by('order_item_id', 'desc');
	$query = $ci->db->get('order_items')->row();
	return $query->order_item_id;
}
function order_status_list()
{
	$order_status[] = array('status_id'=>'1', 'order_status'=>'Pending');
	$order_status[] = array('status_id'=>'2', 'order_status'=>'Payment Received');
	$order_status[] = array('status_id'=>'3', 'order_status'=>'Shipped');
	$order_status[] = array('status_id'=>'4', 'order_status'=>'Refund');
	$order_status[] = array('status_id'=>'5', 'order_status'=>'Cancel');
	
	return $order_status;
}
function get_order_status($order_status)
{
	switch($order_status)
	{
		case 1:
			return 'Pending';
		case 2:
			return 'Payment Received';
		case 3:
			return 'Shipped';
		case 4:
			return 'Refund';
		case 5:
			return 'Cancel';
	}
}

function get_product_stock($product_id)
{
	$ci =& get_instance();

	$ci->db->select('qty');
	$ci->db->where('product_id', $product_id);
	$query = $ci->db->get('products')->row();
	if(!empty($query))
	{
		return $query->qty;
	}
}
//------------------------------------------------------------------------------------------------------------
//------------------------------------------- Calculator -----------------------------------------------------
//------------------------------------------------------------------------------------------------------------
function discount_coupon_code($coupon_code, $price, $discount_price)
{
	$ci =& get_instance();
	$ci->db->select('discount_price, discount_type');
	$ci->db->where('coupon_code', $coupon_code);
	$query = $ci->db->get('coupon')->row();
	if(!empty($query))
	{
		$total_price = $price - $discount_price;
		if($query->discount_type == 1)
			return ($total_price * $query->discount_price)/100;
		else if($query->discount_type==2)
			return $query->discount_price;
		else
			return 0;
	}
}

function cal_shipping_price($shipping_id, $total_weight)
{
	$ci =& get_instance();
	$ci->db->select('price');
	$ci->db->from('shipping_range');
	$ci->db->where('shipping_id', $shipping_id);
	$ci->db->where('weight_min <=', $total_weight);
	$ci->db->where('weight_max >=', $total_weight);
		
	return $ci->db->get()->row()->price;
}

//------------------------------------------------------------------------------------------------------------
//---------------------------------------------- Content -----------------------------------------------------
//------------------------------------------------------------------------------------------------------------
function get_content_list()
{
	$ci =& get_instance();
/*
	$ci->db->select('content.content_id, content.subject, log_content.update_at');
	$ci->db->join('log_content', 'log_content.content_id = content.content_id');
	$ci->db->order_by('content.content_id');
	$ci->db->group_by('content.content_id');
	$query = $ci->db->get('content');

	return $query->result();
	*/
	
	$ci->db->select('*');
	$query = $ci->db->get('content');

	return $query->result();
}

function get_content_id()
{
	$ci =& get_instance();

	$ci->db->select('content_id');
	$ci->db->order_by('content_id', 'desc');
	$query = $ci->db->get('content')->row();
	return $query->content_id;
}

function get_select_content_array($content_id)
{
	$ci =& get_instance();
	$sql_content = "SELECT * FROM content WHERE content_id='".$content_id."'";
	return $ci->db->query($sql_content)->row_array();
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////***************************************************/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////********************INTEGRATED*********************/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////***************************************************///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function in_city($city_id)
{
	$ci =& get_instance();

		$ci->db->select('Name_En');
		$ci->db->from('city_old');
		$ci->db->where('City_ID', $city_id);
	return $ci->db->get()->row()->Name_En;
}
?>
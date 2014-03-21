<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config = array(
		'user_edit' => array(
							array(
									'field' => 'firstname',
									'label' => 'firstname',
									'rules' => 'required'
								),
							array(
									'field' => 'lastname',
									'label' => 'lastname',
									'rules' => 'required'
								),
							array(
									'field' => 'position_id',
									'label' => 'position_id',
									'rules' => 'required'
								),
							array(
									'field' => 'address',
									'label' => 'address',
									'rules' => 'trim'
								),
							array(
									'field' => 'phone',
									'label' => 'phone',
									'rules' => 'required'
								),
							array(
									'field' => 'email',
									'label' => 'email',
									'rules' => 'required|callback_check_edit_email_admin'
								),
							array(
									'field' => 'new_pass',
									'label' => 'new_pass',
									'rules' => 'trim|less_than[6]'
								),
							array(
									'field' => 'conf_pass',
									'label' => 'conf_pass',
									'rules' => 'trim|callback_check_confirmation_pass'
								),
							array(
									'field' => 'cur_pass',
									'label' => 'cur_pass',
									'rules' => 'required|callback_check_current_password'
								)
                  			),
		'admin_create' => array(
		       				array(
									'field' => 'admin_id',
									'label' => 'admin_id',
									'rules' => 'trim'
                       				),
		       				array(
									'field' => 'firstname',
									'label' => 'First Name',
									'rules' => 'required'
                       			),
		       				array(
									'field' => 'lastname',
									'label' => 'Last Name',
									'rules' => 'required'
                       			),
		       				array(
									'field' => 'position_id',
									'label' => 'Position',
									'rules' => 'required'
                       			),
		       				array(
									'field' => 'address',
									'label' => 'address',
									'rules' => 'trim'
                       			),
		       				array(
									'field' => 'phone',
									'label' => 'Phone',
									'rules' => 'required'
                       			),
		       				array(
									'field' => 'email',
									'label' => 'Email',
									'rules' => 'required|callback_check_email_admin'
                       			),
		       				array(
									'field' => 'new_pass',
									'label' => 'Password',
									'rules' => 'required|trim'
                       			),
		       				array(
									'field' => 'conf_pass',
									'label' => 'Confirm Password',
									'rules' => 'required|callback_check_confirmation_pass'
                       			)
							),
		'edit_other_admin' => array(
		       				array(
									'field' => 'admin_id',
									'label' => 'admin_id',
									'rules' => 'required'
                       				),
							array(
									'field' => 'firstname',
									'label' => 'firstname',
									'rules' => 'required'
								),
							array(
									'field' => 'lastname',
									'label' => 'lastname',
									'rules' => 'required'
								),
							array(
									'field' => 'pic',
									'label' => 'pic',
									'rules' => 'trim'
								),
							array(
									'field' => 'position_id',
									'label' => 'position_id',
									'rules' => 'required'
								),
							array(
									'field' => 'address',
									'label' => 'address',
									'rules' => 'trim'
								),
							array(
									'field' => 'phone',
									'label' => 'phone',
									'rules' => 'required'
								),
							array(
									'field' => 'email',
									'label' => 'email',
									'rules' => 'required|callback_check_edit_email_admin'
								),
							array(
									'field' => 'new_pass',
									'label' => 'New Password',
									'rules' => 'trim|min_length[6]'
								),
							array(
									'field' => 'conf_pass',
									'label' => 'conf_pass',
									'rules' => 'trim|callback_check_confirmation_pass'
								)
                  			),
		'customer_create' => array(
							array(
									'field' => 'firstname',
									'label' => 'firstname',
									'rules' => 'required'
								),
							array(
									'field' => 'lastname',
									'label' => 'lastname',
									'rules' => 'required'
								),
							array(
									'field' => 'address',
									'label' => 'address',
									'rules' => 'required'
								),
							array(
									'field' => 'city_id',
									'label' => 'city_id',
									'rules' => 'required'
								),
							array(
									'field' => 'postcode',
									'label' => 'postcode',
									'rules' => 'required'
								),
							array(
									'field' => 'country_id',
									'label' => 'country_id',
									'rules' => 'required'
								),
							array(
									'field' => 'phone',
									'label' => 'phone',
									'rules' => 'required'
								),
							array(
									'field' => 'email',
									'label' => 'email',
									'rules' => 'required|callback_edit_email_customer'
								),
							array(
									'field' => 'newsletter',
									'label' => 'newsletter',
									'rules' => 'trim'
								),
							array(
									'field' => 'birth_date',
									'label' => 'birth_date',
									'rules' => 'trim'
								),
							array(
									'field' => 'new_pass',
									'label' => 'new_pass',
									'rules' => 'required'
								),
							array(
									'field' => 'conf_pass',
									'label' => 'conf_pass',
									'rules' => 'required'
								),
							array(
									'field' => 'b_firstname',
									'label' => 'b_firstname',
									'rules' => 'required'
								),
							array(
									'field' => 'b_lastname',
									'label' => 'b_lastname',
									'rules' => 'required'
								),
							array(
									'field' => 'b_address',
									'label' => 'b_address',
									'rules' => 'required'
								),
							array(
									'field' => 'b_city_id',
									'label' => 'b_city_id',
									'rules' => 'required'
								),
							array(
									'field' => 'b_postcode',
									'label' => 'b_postcode',
									'rules' => 'required'
								),
							array(
									'field' => 'b_country_id',
									'label' => 'b_country_id',
									'rules' => 'required'
								),
							array(
									'field' => 'b_phone',
									'label' => 'b_phone',
									'rules' => 'required'
								),
							array(
									'field' => 's_firstname',
									'label' => 's_firstname',
									'rules' => 'required'
								),
							array(
									'field' => 's_lastname',
									'label' => 's_lastname',
									'rules' => 'required'
								),
							array(
									'field' => 's_address',
									'label' => 's_address',
									'rules' => 'required'
								),
							array(
									'field' => 's_city_id',
									'label' => 's_city_id',
									'rules' => 'required'
								),
							array(
									'field' => 's_postcode',
									'label' => 's_postcode',
									'rules' => 'required'
								),
							array(
									'field' => 's_country_id',
									'label' => 's_country_id',
									'rules' => 'required'
								),
							array(
									'field' => 's_phone',
									'label' => 's_phone',
									'rules' => 'required'
								)									
                  			),
		'edit_customer_contact' => array(
		       				array(
									'field' => 'cus_id',
									'label' => 'cus_id',
									'rules' => 'required'
                       				),
							array(
									'field' => 'firstname',
									'label' => 'firstname',
									'rules' => 'required'
								),
							array(
									'field' => 'lastname',
									'label' => 'lastname',
									'rules' => 'required'
								),
							array(
									'field' => 'address',
									'label' => 'address',
									'rules' => 'required'
								),
							array(
									'field' => 'city_id',
									'label' => 'city_id',
									'rules' => 'required'
								),
							array(
									'field' => 'postcode',
									'label' => 'postcode',
									'rules' => 'required'
								),
							array(
									'field' => 'country_id',
									'label' => 'country_id',
									'rules' => 'required'
								),
							array(
									'field' => 'phone',
									'label' => 'phone',
									'rules' => 'required'
								),
							array(
									'field' => 'email',
									'label' => 'email',
									'rules' => 'required|callback_check_edit_email_customer'
								),
							array(
									'field' => 'newsletter',
									'label' => 'newsletter',
									'rules' => 'trim'
								),
							array(
									'field' => 'new_pass',
									'label' => 'new_pass',
									'rules' => 'trim|less_than[6]'
								),
							array(
									'field' => 'conf_pass',
									'label' => 'conf_pass',
									'rules' => 'trim|callback_check_confirmation_pass'
								),
							array(
									'field' => 'birth_date',
									'label' => 'birth_date',
									'rules' => 'trim'
								),
							array(
									'field' => 'create_at',
									'label' => 'create_at',
									'rules' => 'trim'
								)
                  			),
		'edit_customer_billing' => array(
		       				array(
									'field' => 'cus_id',
									'label' => 'cus_id',
									'rules' => 'required'
                       				),
							array(
									'field' => 'b_firstname',
									'label' => 'b_firstname',
									'rules' => 'required'
								),
							array(
									'field' => 'b_lastname',
									'label' => 'b_lastname',
									'rules' => 'required'
								),
							array(
									'field' => 'b_address',
									'label' => 'b_address',
									'rules' => 'required'
								),
							array(
									'field' => 'b_city_id',
									'label' => 'b_city_id',
									'rules' => 'required'
								),
							array(
									'field' => 'b_postcode',
									'label' => 'b_postcode',
									'rules' => 'required'
								),
							array(
									'field' => 'b_country_id',
									'label' => 'b_country_id',
									'rules' => 'required'
								),
							array(
									'field' => 'b_phone',
									'label' => 'b_phone',
									'rules' => 'required'
								)
                  			),
		'edit_customer_shipping' => array(
		       				array(
									'field' => 'cus_id',
									'label' => 'cus_id',
									'rules' => 'required'
                       				),
							array(
									'field' => 's_firstname',
									'label' => 's_firstname',
									'rules' => 'required'
								),
							array(
									'field' => 's_lastname',
									'label' => 's_lastname',
									'rules' => 'required'
								),
							array(
									'field' => 's_address',
									'label' => 's_address',
									'rules' => 'required'
								),
							array(
									'field' => 's_city_id',
									'label' => 's_city_id',
									'rules' => 'required'
								),
							array(
									'field' => 's_postcode',
									'label' => 's_postcode',
									'rules' => 'required'
								),
							array(
									'field' => 's_country_id',
									'label' => 's_country_id',
									'rules' => 'required'
								),
							array(
									'field' => 's_phone',
									'label' => 's_phone',
									'rules' => 'required'
								)
                  			),
        'create_customer_group' => array(
      						array(
									'field' => 'name',
									'label' => 'name',
									'rules' => 'required|callback_check_name_cus_group'
								),
							array(
									'field' => 'description',
									'label' => 'description',
									'rules' => 'trim'
								)
							),
		'edit_customer_group' => array(
		       				array(
									'field' => 'cusgroup_id',
									'label' => 'cusgroup_id',
									'rules' => 'required'
                       			),
							array(
									'field' => 'name',
									'label' => 'name',
									'rules' => 'required|callback_check_edit_name_cus_group'
								),
							array(
									'field' => 'description',
									'label' => 'description',
									'rules' => 'trim'
								)
                  			),
		'edit_groupMember' => array(
		       				array(
									'field' => 'cusgroup_id',
									'label' => 'cusgroup_id',
									'rules' => 'required'
                       			),
							array(
									'field' => 'name',
									'label' => 'name',
									'rules' => 'trim'
								)
                  			),
		'create_category' => array(
		       				array(
									'field' => 'name',
									'label' => 'name',
									'rules' => 'required|callback_check_name_category'
                       			),
							array(
									'field' => 'sel_lv',
									'label' => 'sel_lv',
									'rules' => 'required'
								),
							array(
									'field' => 'sel_lv1',
									'label' => 'sel_lv1',
									'rules' => 'trim|callback_check_select_lv1'
								),
							array(
									'field' => 'sel_lv2',
									'label' => 'sel_lv2',
									'rules' => 'trim|callback_check_select_lv2'
								),
							array(
									'field' => 'url',
									'label' => 'url',
									'rules' => 'required|alpha_numeric|callback_check_url_category'
								),
							array(
									'field' => 'public',
									'label' => 'public',
									'rules' => 'trim'
								),
							array(
									'field' => 'title',
									'label' => 'title',
									'rules' => 'trim'
								),
							array(
									'field' => 'meta_keyword',
									'label' => 'meta_keyword',
									'rules' => 'trim'
								),
							array(
									'field' => 'meta_description',
									'label' => 'meta_description',
									'rules' => 'trim'
								)
                  			),
		'edit_category' => array(
		       				array(
									'field' => 'cat_id',
									'label' => 'cat_id',
									'rules' => 'required'
                       				),
		       				array(
									'field' => 'name',
									'label' => 'name',
									'rules' => 'required|callback_check_edit_name_category'
                       			),
							array(
									'field' => 'level',
									'label' => 'level',
									'rules' => 'required'
								),
							array(
									'field' => 'main_id',
									'label' => 'main_id',
									'rules' => 'required'
								),
							array(
									'field' => 'sub_id',
									'label' => 'sub_id',
									'rules' => 'required'
								),
							array(
									'field' => 'rank',
									'label' => 'rank',
									'rules' => 'required'
								),
							array(
									'field' => 'url',
									'label' => 'url',
									'rules' => 'required|alpha_numeric|callback_check_edit_url_category'
								),
							array(
									'field' => 'public',
									'label' => 'public',
									'rules' => 'trim'
								),
							array(
									'field' => 'title',
									'label' => 'title',
									'rules' => 'trim'
								),
							array(
									'field' => 'meta_keyword',
									'label' => 'meta_keyword',
									'rules' => 'trim'
								),
							array(
									'field' => 'meta_description',
									'label' => 'meta_description',
									'rules' => 'trim'
								)
                  			),
	'create_product_group' => array(
							array(
									'field' => 'progroup_id',
									'label' => 'progroup_id',
									'rules' => 'required'
                       			),
		       				array(
									'field' => 'name',
									'label' => 'name',
									'rules' => 'required|callback_check_name_pro_group'
                       			),
							array(
									'field' => 'public',
									'label' => 'public',
									'rules' => 'trim'
								),
							array(
									'field' => 'url',
									'label' => 'url',
									'rules' => 'required|callback_check_url_pro_group'
                       			),
							array(
									'field' => 'title',
									'label' => 'title',
									'rules' => 'trim'
                       			),
							array(
									'field' => 'meta_keyword[]',
									'label' => 'meta_keyword[]',
									'rules' => 'trim'
                       			),
							array(
									'field' => 'meta_description',
									'label' => 'meta_description',
									'rules' => 'trim'
								)
                  			),
    'edit_product_group' => array(
							array(
									'field' => 'select_id',
									'label' => 'select_id',
									'rules' => 'required'
                       			),
							array(
									'field' => 'rank',
									'label' => 'rank',
									'rules' => 'trim'
                       			),
							array(
									'field' => 'progroup_id',
									'label' => 'progroup_id',
									'rules' => 'required|callback_check_edit_id_pro_group'
                       			),
		       				array(
									'field' => 'name',
									'label' => 'name',
									'rules' => 'required|callback_check_edit_name_pro_group'
                       			),
							array(
									'field' => 'public',
									'label' => 'public',
									'rules' => 'trim'
								),
							array(
									'field' => 'url',
									'label' => 'url',
									'rules' => 'required|callback_check_edit_url_pro_group'
                       			),
							array(
									'field' => 'title',
									'label' => 'title',
									'rules' => 'trim'
                       			),
							array(
									'field' => 'meta_keyword[]',
									'label' => 'meta_keyword[]',
									'rules' => 'trim'
                       			),
							array(
									'field' => 'meta_description',
									'label' => 'meta_description',
									'rules' => 'trim'
								)
                  			),
    'create_product' => array(
							array(
									'field' => 'userfile1',
									'label' => 'Image',
									'rules' => 'trim|callback_check_create_product_image'
								),
							array(
									'field' => 'product_id',
									'label' => 'product_id',
									'rules' => 'trim'
                       			),
							array(
									'field' => 'progroup_id',
									'label' => 'progroup_id',
									'rules' => 'required'
                       			),
							array(
									'field' => 'rank',
									'label' => 'rank',
									'rules' => 'trim'
                       			),
		       				array(
									'field' => 'name',
									'label' => 'name',
									'rules' => 'required|callback_check_name_product'
                       			),
		       				array(
									'field' => 'prop_id',
									'label' => 'prop_id',
									'rules' => 'required'
                       			),
		       				array(
									'field' => 'color_id',
									'label' => 'color_id',
									'rules' => 'required'
                       			),
		       				array(
									'field' => 'attribute_id',
									'label' => 'attribute_id',
									'rules' => 'required'
                       			),
		       				array(
									'field' => 'size',
									'label' => 'size',
									'rules' => 'required'
                       			),
		       				array(
									'field' => 'weight',
									'label' => 'weight',
									'rules' => 'required'
                       			),
		       				array(
									'field' => 'price',
									'label' => 'price',
									'rules' => 'required'
                       			),
		       				array(
									'field' => 'discount',
									'label' => 'discount',
									'rules' => 'trim'
                       			),
		       				array(
									'field' => 'discount_type',
									'label' => 'discount_type',
									'rules' => 'trim|callback_check_discount_type'
                       			),
		       				array(
									'field' => 'qty',
									'label' => 'qty',
									'rules' => 'required'
                       			),
		       				array(
									'field' => 'description',
									'label' => 'description',
									'rules' => 'trim'
                       			),
                       		array(
									'field' => 'primary',
									'label' => 'primary',
									'rules' => 'trim'
								),
                       		array(
									'field' => 'public',
									'label' => 'public',
									'rules' => 'trim'
								),
		       				array(
									'field' => 'flag',
									'label' => 'flag',
									'rules' => 'trim'
                       			),
                  			),

	'edit_product' => array(
							array(
									'field' => 'product_id',
									'label' => 'product_id',
									'rules' => 'required'
                       			),
							array(
									'field' => 'progroup_id',
									'label' => 'progroup_id',
									'rules' => 'required'
                       			),
							array(
									'field' => 'rank',
									'label' => 'rank',
									'rules' => 'required'
                       			),
		       				array(
									'field' => 'name',
									'label' => 'name',
									'rules' => 'required|callback_check_edit_name_product'
                       			),
		       				array(
									'field' => 'prop_id',
									'label' => 'prop_id',
									'rules' => 'required'
                       			),
		       				array(
									'field' => 'color_id',
									'label' => 'color_id',
									'rules' => 'required'
                       			),
		       				array(
									'field' => 'attribute_id',
									'label' => 'attribute_id',
									'rules' => 'required'
                       			),
		       				array(
									'field' => 'size',
									'label' => 'size',
									'rules' => 'required'
                       			),
		       				array(
									'field' => 'weight',
									'label' => 'weight',
									'rules' => 'required'
                       			),
		       				array(
									'field' => 'price',
									'label' => 'price',
									'rules' => 'required'
                       			),
		       				array(
									'field' => 'discount',
									'label' => 'discount',
									'rules' => 'trim'
                       			),
		       				array(
									'field' => 'discount_type',
									'label' => 'discount_type',
									'rules' => 'trim|callback_check_discount_type'
                       			),
		       				array(
									'field' => 'qty',
									'label' => 'qty',
									'rules' => 'required'
                       			),
		       				array(
									'field' => 'description',
									'label' => 'description',
									'rules' => 'trim'
                       			),
                       		array(
									'field' => 'primary',
									'label' => 'primary',
									'rules' => 'trim'
								),
                       		array(
									'field' => 'public',
									'label' => 'public',
									'rules' => 'trim'
								),
		       				array(
									'field' => 'flag',
									'label' => 'flag',
									'rules' => 'trim'
                       			)
                  	        ),
    'create_color' => array(
		       				array(
									'field' => 'color_id',
									'label' => 'color_id',
									'rules' => 'trim'
                       				),
		       				array(
									'field' => 'name',
									'label' => 'name',
									'rules' => 'required|callback_check_name_color'
                       			),
							array(
									'field' => 'public',
									'label' => 'public',
									'rules' => 'trim'
								),
							array(
									'field' => 'path',
									'label' => 'image',
									'rules' => 'trim'
								)
                  			),
	'edit_color' => array(
		       				array(
									'field' => 'color_id',
									'label' => 'color_id',
									'rules' => 'trim'
                       				),
		       				array(
									'field' => 'name',
									'label' => 'name',
									'rules' => 'required|callback_check_edit_name_color'
                       			),
							array(
									'field' => 'public',
									'label' => 'public',
									'rules' => 'trim'
								),
							array(
									'field' => 'path',
									'label' => 'image',
									'rules' => 'trim'
								)
							
                  			),
   'create_property' => array(
		       				array(
									'field' => 'prop_id',
									'label' => 'prop_id',
									'rules' => 'trim'
                       				),
		       				array(
									'field' => 'name',
									'label' => 'name',
									'rules' => 'required|callback_check_name_property'
                       			),
							array(
									'field' => 'public',
									'label' => 'public',
									'rules' => 'trim'
								),
							array(
									'field' => 'path',
									'label' => 'image',
									'rules' => 'trim'
								)
                  			),

	'edit_property' => array(
		       				array(
									'field' => 'prop_id',
									'label' => 'prop_id',
									'rules' => 'trim'
                       				),
		       				array(
									'field' => 'name',
									'label' => 'name',
									'rules' => 'required|callback_check_edit_name_property'
                       			),
							array(
									'field' => 'public',
									'label' => 'public',
									'rules' => 'trim'
								),
							array(
									'field' => 'path',
									'label' => 'image',
									'rules' => 'trim'
								)
                  			),
    'create_attribute' => array(
		       				array(
									'field' => 'attribute_id',
									'label' => 'attribute_id',
									'rules' => 'trim'
                       				),
		       				array(
									'field' => 'name',
									'label' => 'name',
									'rules' => 'required|callback_check_name_attribute'
                       			),
							array(
									'field' => 'public',
									'label' => 'public',
									'rules' => 'trim'
								)
                  			),
		
	'edit_attribute' => array(
		       				array(
									'field' => 'attribute_id',
									'label' => 'attribute_id',
									'rules' => 'trim'
                       				),
		       				array(
									'field' => 'name',
									'label' => 'name',
									'rules' => 'required|callback_check_edit_name_attribute'
                       			),
							array(
									'field' => 'public',
									'label' => 'public',
									'rules' => 'trim'
								)
                  			),
    'create_keyword' => array(
		       				array(
									'field' => 'keyword_id',
									'label' => 'keyword_id',
									'rules' => 'trim'
                       				),
		       				array(
									'field' => 'name',
									'label' => 'name',
									'rules' => 'required|callback_check_name_keyword'
                       			)
                  			),
              			
	'edit_keyword' => array(
		       				array(
									'field' => 'keyword_id',
									'label' => 'keyword_id',
									'rules' => 'trim'
                       				),
		       				array(
									'field' => 'name',
									'label' => 'name',
									'rules' => 'required|callback_check_edit_name_keyword'
                       			)
                  			),
    'create_keyword_group' => array(
								array(
										'field' => 'keygroup_id',
										'label' => 'keygroup_id',
										'rules' => 'trim'
										),
								array(
										'field' => 'name',
										'label' => 'name',
										'rules' => 'required|callback_check_name_keyword_group'
									)
                  			),
	'edit_keyword_group' => array(
								array(
										'field' => 'keygroup_id',
										'label' => 'keygroup_id',
										'rules' => 'trim'
										),
								array(
										'field' => 'name',
										'label' => 'name',
										'rules' => 'required|callback_check_edit_name_keyword_group'
									)
                  			),
    'create_shipping' => array(
								array(
										'field' => 'name',
										'label' => 'name',
										'rules' => 'required|callback_check_name_shipping'
										),
								array(
										'field' => 'description',
										'label' => 'description',
										'rules' => 'trim'
									)
                  			),
    'edit_shipping' => array(
								array(
										'field' => 'name',
										'label' => 'name',
										'rules' => 'required|callback_check_edit_name_shipping'
										),
								array(
										'field' => 'description',
										'label' => 'description',
										'rules' => 'trim'
									)
                  			),
    'create_shipping_range' => array(
								array(
										'field' => 'weight_min',
										'label' => 'weight min',
										'rules' => 'required'
										),
								array(
										'field' => 'weight_max',
										'label' => 'weight max',
										'rules' => 'required'
										),
								array(	
										'field' => 'price',
										'label' => 'price',
										'rules' => 'required'
									)
								),
     'edit_shipping_range' => array(
								array(
										'field' => 'weight_min',
										'label' => 'weight min',
										'rules' => 'required'
										),
								array(
										'field' => 'weight_max',
										'label' => 'weight max',
										'rules' => 'required'
										),
								array(
										'field' => 'price',
										'label' => 'price',
										'rules' => 'required'
									)
								),
		'create_payment' => array(
								array(
										'field' => 'name',
										'label' => 'name',
										'rules' => 'required|callback_check_name_payment'
										),
								array(
										'field' => 'description',
										'label' => 'description',
										'rules' => 'trim'
										),
								array(
										'field' => 'userfile',
										'label' => 'image',
										'rules' => 'callback_checK_file'
									),
								array(
										'field' => 'public',
										'label' => 'public',
										'rules' => 'trim'
									)
                  			),
		'edit_payment' => array(
								array(
										'field' => 'name',
										'label' => 'name',
										'rules' => 'required|callback_check_edit_name_payment'
										),
								array(
										'field' => 'description',
										'label' => 'description',
										'rules' => 'trim'
										),
								array(
										'field' => 'path',
										'label' => 'path',
										'rules' => 'trim'
									),
								array(
										'field' => 'public',
										'label' => 'public',
										'rules' => 'trim'
									)
                  			),
         'edit_order' => array(
								array(
										'field' => 'order_id',
										'label' => 'order_id',
										'rules' => 'required'
										),
								array(
										'field' => 'cus_id',
										'label' => 'cus_id',
										'rules' => 'trim'
										),
								array(
										'field' => 'price',
										'label' => 'price',
										'rules' => 'trim'
									),
								array(
										'field' => 'discount_price',
										'label' => 'discount_price',
										'rules' => 'trim'
									),
								array(
										'field' => 'coupon_code',
										'label' => 'coupon_code',
										'rules' => 'trim'
									),
								array(
										'field' => 'discount_coupon',
										'label' => 'discount_coupon',
										'rules' => 'trim'
									),
								array(
										'field' => 'total_price',
										'label' => 'total_price',
										'rules' => 'trim'
									),
								array(
										'field' => 'total_weight',
										'label' => 'total_weight',
										'rules' => 'trim'
									),
								array(
										'field' => 'shipping_id',
										'label' => 'shipping_id',
										'rules' => 'trim'
									),
								array(
										'field' => 'shipping_price',
										'label' => 'shipping_price',
										'rules' => 'trim'
									),
								array(
										'field' => 'final_price',
										'label' => 'final_price',
										'rules' => 'trim'
									),
								array(
										'field' => 'order_status',
										'label' => 'order_status',
										'rules' => 'trim'
									),
								array(
										'field' => 'shipping_number',
										'label' => 'shipping_number',
										'rules' => 'trim'
									)
                  			),
         'edit_order_billing' => array(
		       				array(
									'field' => 'order_id',
									'label' => 'order_id',
									'rules' => 'required'
                       				),
							array(
									'field' => 'b_firstname',
									'label' => 'b_firstname',
									'rules' => 'required'
								),
							array(
									'field' => 'b_lastname',
									'label' => 'b_lastname',
									'rules' => 'required'
								),
							array(
									'field' => 'b_address',
									'label' => 'b_address',
									'rules' => 'required'
								),
							array(
									'field' => 'b_city_id',
									'label' => 'b_city_id',
									'rules' => 'required'
								),
							array(
									'field' => 'b_postcode',
									'label' => 'b_postcode',
									'rules' => 'required'
								),
							array(
									'field' => 'b_country_id',
									'label' => 'b_country_id',
									'rules' => 'required'
								),
							array(
									'field' => 'b_phone',
									'label' => 'b_phone',
									'rules' => 'required'
								),
							array(
									'field' => 'payment_id',
									'label' => 'payment_id',
									'rules' => 'required'
								)
                  			),
		'edit_order_shipping' => array(
		       				array(
									'field' => 'order_id',
									'label' => 'order_id',
									'rules' => 'required'
                       				),
							array(
									'field' => 's_firstname',
									'label' => 's_firstname',
									'rules' => 'required'
								),
							array(
									'field' => 's_lastname',
									'label' => 's_lastname',
									'rules' => 'required'
								),
							array(
									'field' => 's_address',
									'label' => 's_address',
									'rules' => 'required'
								),
							array(
									'field' => 's_city_id',
									'label' => 's_city_id',
									'rules' => 'required'
								),
							array(
									'field' => 's_postcode',
									'label' => 's_postcode',
									'rules' => 'required'
								),
							array(
									'field' => 's_country_id',
									'label' => 's_country_id',
									'rules' => 'required'
								),
							array(
									'field' => 's_phone',
									'label' => 's_phone',
									'rules' => 'required'
								),
							array(
									'field' => 'shipping_id',
									'label' => 'shipping_id',
									'rules' => 'required'
								)
                  			),
         'check_order' => array(
							array(
									'field' => 'coupon',
									'label' => 'coupon',
									'rules' => 'trim|callback_check_coupon_can_use'
                       			),
                       		array(
                       				'field' => 'check',
                       				'label' => 'check',
                       				'rules' => 'required|callback_check_select_product|callback_check_order_product_qty'
                       			),
							array(
									'field' => 'b_firstname',
									'label' => 'b_firstname',
									'rules' => 'required'
								),
							array(
									'field' => 'b_lastname',
									'label' => 'b_lastname',
									'rules' => 'required'
								),
							array(
									'field' => 'b_address',
									'label' => 'b_address',
									'rules' => 'required'
								),
							array(
									'field' => 'b_city_id',
									'label' => 'b_city_id',
									'rules' => 'required'
								),
							array(
									'field' => 'b_postcode',
									'label' => 'b_postcode',
									'rules' => 'required'
								),
							array(
									'field' => 'b_country_id',
									'label' => 'b_country_id',
									'rules' => 'required'
								),
							array(
									'field' => 'b_phone',
									'label' => 'b_phone',
									'rules' => 'required'
								),
								array(
									'field' => 's_firstname',
									'label' => 's_firstname',
									'rules' => 'required'
								),
							array(
									'field' => 's_lastname',
									'label' => 's_lastname',
									'rules' => 'required'
								),
							array(
									'field' => 's_address',
									'label' => 's_address',
									'rules' => 'required'
								),
							array(
									'field' => 's_city_id',
									'label' => 's_city_id',
									'rules' => 'required'
								),
							array(
									'field' => 's_postcode',
									'label' => 's_postcode',
									'rules' => 'required'
								),
							array(
									'field' => 's_country_id',
									'label' => 's_country_id',
									'rules' => 'required'
								),
							array(
									'field' => 's_phone',
									'label' => 's_phone',
									'rules' => 'required'
								),
							array(
									'field' => 'shipping_id',
									'label' => 'shipping method',
									'rules' => 'required|callback_check_shipping_method'
								)
							),
	 'create_content' => array(
								array(
										'field' => 'subject',
										'label' => 'subject',
										'rules' => 'required'
										),
								array(
										'field' => 'description',
										'label' => 'description',
										'rules' => 'trim'
									)
                  			),
	'edit_content' => array(
								array(
										'field' => 'content_id',
										'label' => 'content_id',
										'rules' => 'required'
										),
								array(
										'field' => 'subject',
										'label' => 'subject',
										'rules' => 'required'
										),
								array(
										'field' => 'description',
										'label' => 'description',
										'rules' => 'trim'
									)
                  			)
							
        		);

/* End of file form_validation.php */
/* Location: ./application/config/form_validation.php */

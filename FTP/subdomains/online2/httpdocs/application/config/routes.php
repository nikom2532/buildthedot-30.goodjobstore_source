<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "auth/login";
$route['404_override'] = '';

$route['login'] = "auth/login";
$route['register'] = "auth/register";
$route['logout'] = "auth/logout";

$route['home'] = "home";
$route['home/(:any)'] = "home/$1";

$route['order'] = "order/view";
$route['order/create'] = "order/create";
$route['order/create/(:any)/check'] = "order/create_step3/$1";
$route['order/create/(:any)'] = "order/create_step2/$1";
$route['order/edit/order/(:any)']= "order/edit_order/$1";
$route['order/edit/billing/(:any)']= "order/edit_order_billing/$1";
$route['order/edit/shipping/(:any)']= "order/edit_order_shipping/$1";
$route['order/edit/item/(:any)'] = "order/edit_order_item/$1";
$route['order/status/(:any)'] = "order/change_order_status/$1";

$route['product'] = "product/view";
//$route['product/create'] = "product/create_product";
$route['product/manage'] = "product/manage_product_group";
$route['product/group/manage'] = "product/manage_group";
$route['product/group/create'] = "product/create_product_group";
$route['product/group/edit/(:any)'] = "product/edit_product_group/$1";
$route['product/view/(:any)/(:any)/create'] = "product/create_product_image/$1/$2";
$route['product/view/(:any)/(:any)/edit'] = "product/edit_product/$1/$2";
$route['product/view/(:any)/(:any)/images/manage'] = "product/manage_product_image/$1/$2";
$route['product/view/(:any)/create'] = "product/create_product/$1";
$route['product/view/(:any)/manage'] = "product/manage_product/$1";
$route['product/(:any)'] = "product/$1";

$route['category'] = "category/view";
$route['category/edit/(:any)'] = "category/edit_cat/$1"; 
$route['category/(:any)'] = "category/$1";

$route['shipping/range/(:any)/edit'] = "shipping/edit_shipping_range/$1";
$route['shipping/range/(:any)/create'] = "shipping/create_shipping_range/$1";
$route['shipping/view/(:any)'] = "shipping/view/$1";

$route['customer/profile/edit/contact/(:any)'] = "customer/edit_contact/$1";
$route['customer/profile/edit/billing/(:any)'] = "customer/edit_billing/$1";
$route['customer/profile/edit/shipping/(:any)'] = "customer/edit_shipping/$1";

$route['customer/group/create'] = "customer/group_create";
$route['customer/group/edit/(:any)'] = "customer/group_edit/$1";
$route['customer/group/member/edit/(:any)'] = "customer/groupMember_edit/$1";
$route['customer/group/(:any)'] = "customer/group_view/$1";

$route['content/edit/(:any)'] = "content/edit_content/$1"; 

$route['preference/color/edit/(:any)'] = "preference/edit_color/$1";
$route['preference/property/edit/(:any)'] = "preference/edit_property/$1";
$route['preference/attribute/edit/(:any)'] = "preference/edit_attribute/$1";
$route['preference/keyword/edit/(:any)'] = "preference/edit_keyword/$1";
$route['preference/keyword_group/edit/(:any)'] = "preference/edit_keyword_group/$1";

/* End of file routes.php */
/* Location: ./application/config/routes.php */
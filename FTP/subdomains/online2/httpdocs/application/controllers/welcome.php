<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function admins()
	{
		$employees_old = $this->db->get('employees_old')->result();
		foreach($employees_old as $employees_old)
		{
			/*
			echo $employees_old->Emp_ID."<BR>";
			echo $employees_old->FirstName."<BR>";
			echo $employees_old->LastName."<BR>";
			echo $employees_old->Email."<BR>";
			echo $employees_old->Password."<BR>";
			echo $employees_old->Position_ID."<BR>";
			echo $employees_old->Address." ".$employees_old->City_ID." ".$employees_old->Postal_Code."<BR>";
			echo $employees_old->City_ID." : ".in_city($employees_old->City_ID)."<BR>";
			echo $employees_old->Phone_Number."<BR>";
			*/
			$detail = array(
							'admin_id' => $employees_old->Emp_ID,
							'firstname' => $employees_old->FirstName,
							'lastname' => $employees_old->LastName,
							'email' => $employees_old->Email,
							'password' => $employees_old->Password,
							'position_id' => $employees_old->Position_ID,
							'address' => $employees_old->Address." ".in_city($employees_old->City_ID)." ".$employees_old->Postal_Code,
							'phone' => $employees_old->Phone_Number,
						);
			//var_dump($detail);
			//echo "<hr>";
			$this->db->insert('admins', $detail);
		}
		echo 'admins finish';
	}

	public function city()
	{
		$city_old = $this->db->get('city_old')->result();
		foreach($city_old as $city_old)
		{
			/*
			echo $city_old->City_ID."<BR>";
			echo $city_old->Name_Th."<BR>";
			echo $city_old->Name_En."<BR>";
			echo "<hr>";
			*/
			$detail = array(
							'city_id' => $city_old->City_ID,
							'name' => $city_old->Name_En,
						);
			$this->db->insert('city', $detail);
			
			$lang = array(
							'lang_id' => '2',
							'city_id' => $city_old->City_ID,
							'name' => $city_old->Name_Th,
						);
			$this->db->insert('city_lang', $lang);
		}
		echo "city finish";
	}
	public function country()
	{
		$country_old = $this->db->get('country_old')->result();
		foreach($country_old as $country_old)
		{
			/*
			echo $country_old->Country_ID."<BR>";
			echo $country_old->country_name."<BR>";
			echo "<hr>";
			*/
			$detail = array(
							'country_id' => $country_old->Country_ID,
							'name' => $country_old->country_name,
							'ISO2_alpha' => $country_old->ISO2_alpha,
							'ISO3_alpha' => $country_old->ISO3_alpha,
							'IANA_internet' => $country_old->IANA_internet,
							'UN_vehicle' => $country_old->UN_vehicle,
							'IOC_olympic' => $country_old->IOC_olympic,
							'UN_ISO_numeric' => $country_old->UN_ISO_numeric,
							'ITU_calling' => $country_old->ITU_calling,
						);
			$this->db->insert('country', $detail);

			$lang = array(
							'lang_id' => '2',
							'country_id' => $country_old->Country_ID,
							'name' => $country_old->country_name_th,
							'ISO2_alpha' => $country_old->ISO2_alpha,
							'ISO3_alpha' => $country_old->ISO3_alpha,
							'IANA_internet' => $country_old->IANA_internet,
							'UN_vehicle' => $country_old->UN_vehicle,
							'IOC_olympic' => $country_old->IOC_olympic,
							'UN_ISO_numeric' => $country_old->UN_ISO_numeric,
							'ITU_calling' => $country_old->ITU_calling,
						);
			$this->db->insert('country_lang', $lang);
		}
		echo "country finish";
	}
	public function property()
	{
		$property_old = $this->db->get('property_old')->result();
		$i=1;
		foreach($property_old as $property_old)
		{
			/*
			echo $property_old->prop_id."<BR>";
			echo $property_old->name_en."<BR>";
			echo "<hr>";
			*/
			$detail = array(
							'prop_id' => $property_old->prop_id,
							'name' => $property_old->name_en,
							'public' => '1',
							'rank' => $i
						);
			$this->db->insert('property', $detail);

			$lang = array(
							'lang_id' => '2',
							'prop_id' => $property_old->prop_id,
							'name' => $property_old->name_th,
							'public' => '1',
							'rank' => $i
						);
			$this->db->insert('property_lang', $lang);
		}
		echo "property finish";
	}
	public function color()
	{
		$color_old = $this->db->get('color_old')->result();
		$i=1;
		foreach($color_old as $color_old)
		{
			$detail = array(
							'color_id' => $color_old->Color_ID,
							'name' => $color_old->Name_EN,
							'public' => '1',
							'rank' => $i,
							'path' => $color_old->path
						);
			$this->db->insert('color', $detail);

			$lang = array(
							'lang_id' => '2',
							'color_id' => $color_old->Color_ID,
							'name' => $color_old->Name_EN,
							'public' => '1',
							'rank' => $i,
							'path' => $color_old->path
						);
			$this->db->insert('color_lang', $lang);
		}
		echo "color finish";
	}
	public function position()
	{
		$positions_old = $this->db->get('positions_old')->result();
		foreach($positions_old as $positions_old)
		{
			$detail = array(
							'position_id' => $positions_old->Position_ID,
							'name' => $positions_old->Position_name
						);
			$this->db->insert('positions', $detail);

			$lang = array(
							'lang_id' => '2',
							'position_id' => $positions_old->Position_ID,
							'name' => $positions_old->Position_name
						);
			$this->db->insert('positions_lang', $lang);
		}
		echo "position finish";
	}
	public function attribute()
	{
		$attributes_old = $this->db->get('attributes_old')->result();
		foreach($attributes_old as $attributes_old)
		{
			$detail = array(
							'attribute_id' => $attributes_old->id,
							'name' => $attributes_old->en,
							'public' => 1
						);
			$this->db->insert('attribute', $detail);

			$lang = array(
							'lang_id' => '2',
							'attribute_id' => $attributes_old->id,
							'name' => $attributes_old->th,
							'public' => 1
						);
			$this->db->insert('attribute_lang', $lang);
		}
		echo "attribute finish";
	}
	public function shipping()
	{
		///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		$objCon = mysql_connect("localhost","integrated","121212") or die(mysql_error());
		$objDB = mysql_select_db("integrated") or die("Can't connect Database");
		mysql_query("SET NAMES utf8",$objCon);

		$sql = "SELECT * FROM how_delivery_old";
		$result = mysql_query($sql, $objCon) or die(mysql_error());
		
		while ($data=mysql_fetch_array($result))
		{
			//echo $data['Description_En']."<hr>";
			$sql = "INSERT INTO shipping (shipping_id, name, description) 
					VALUES ('".$data['How_ID']."','".$data['Name_En']."','".$data['Description_En']."')";
			mysql_query($sql, $objCon) or die(mysql_error());
			
			//echo $data['Description_En']."<hr>";
			$sql = "INSERT INTO shipping_lang (lang_id, shipping_id, name, description) 
					VALUES ('2', '".$data['How_ID']."','".$data['Name_Th']."','".$data['Description_Th']."')";
			mysql_query($sql, $objCon) or die(mysql_error());
		}
		
		mysql_close($objCon);
		echo 'shipping finish';
	}
	public function shipping_range()
	{
		$range_weight_old = $this->db->get('range_weight_old')->result();
		foreach($range_weight_old as $range_weight_old)
		{
			$detail = array(
							'range_id' => $range_weight_old->Range_ID,
							'shipping_id' => $range_weight_old->How_ID,
							'weight_min' => $range_weight_old->Weight_Start,
							'weight_max' => $range_weight_old->Weight_End,
							'price' => $range_weight_old->Price
						);
			$this->db->insert('shipping_range', $detail);
		}
		echo "shipping_range finish";
	}
	public function payment()
	{
		$payments_old = $this->db->get('payments_old')->result();
		foreach($payments_old as $payments_old)
		{
			$detail = array(
							'payment_id' => $payments_old->id,
							'name' => $payments_old->name_en,
							'description' => $payments_old->description_en,
							'path' => $payments_old->picture_path,
							'public' => 1
						);
			$this->db->insert('payment', $detail);

			$lang = array(
							'lang_id' => '2',
							'payment_id' => $payments_old->id,
							'name' => $payments_old->name_th,
							'description' => $payments_old->description_th,
							'path' => $payments_old->picture_path,
							'public' => 1
						);
			$this->db->insert('payment_lang', $lang);
		}
		echo "payment finish";
	}
	public function coupon()
	{
		$coupon_old = $this->db->get('coupon_old')->result();
		foreach($coupon_old as $coupon_old)
		{
			if($coupon_old->Discount_Status == '1')
			{
				$discount_price = $coupon_old->Discount_PC;
				$discount_type = '1';
			}
			else if($coupon_old->Discount_Status == '2')
			{
				$discount_price = $coupon_old->Discount_Cash;
				$discount_type = '2';
			}
			$detail = array(
							'coupon_code' => $coupon_old->Coupon_ID,
							'discount_price' => $discount_price,
							'discount_type' => $discount_type,
							'start_date' => $coupon_old->Start_Date,
							'end_date' => $coupon_old->Expired_Date,
							'coupon_status' => $coupon_old->Price,
							'create_at' => $coupon_old->Price
						);
			$this->db->insert('coupon', $detail);
		}
		echo "coupon finish";
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
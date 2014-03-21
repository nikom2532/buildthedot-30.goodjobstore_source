<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config = array(
			'customer' => array(
								array(
										'field' => 'Cus_ID',
                             			'label' => 'ID',
                                	    'rules' => 'required'
                         			),
                         		array(
										'field' => 'FirstName',
                             			'label' => 'FirstName',
                                	    'rules' => 'trim'
                         			),

                         		array(
                         				'field' => 'LastName',
                         				'label' => 'LastName',
                         				'rules' => 'trim'
                         		),
                         		array(
                         				'field' => 'Address',
                         				'label' => 'Address',
                         				'rules' => 'trim'
                         		),
                         		array(
                         				'field' => 'City_ID',
                         				'label' => 'City_ID',
                         				'rules' => 'trim'
                         		),
                         		array(
                         				'field' => 'Country_ID',
                         				'label' => 'Country_ID',
                         				'rules' => 'trim'
                         		),
                         		array(
                         				'field' => 'City_Name',
                         				'label' => 'City_Name',
                         				'rules' => 'trim'
                         		),
                         		array(
                         				'field' => 'Postal_Code',
                         				'label' => 'Postal_Codel',
                         				'rules' => 'trim'
                         		),
                         		array(
                         				'field' => 'Phone_Number',
                         				'label' => 'Phone_Number',
                         				'rules' => 'trim'		
                         		),
                         		array(
                         				'field' => 'Email',
                         				'label' => 'Email',
                         				'rules' => 'trim'		
                         		)
                          	
                        	),
           'shipping' => array(
								array(
										'field' => 'Shipping_ID',
                             			'label' => 'Shipping_ID',
                                	    'rules' => 'trim'
                         			),
                         		array(
										'field' => 's_FirstName',
                             			'label' => 'FirstName',
                                	    'rules' => 'trim'
                         			),

                         		array(
                         				'field' => 's_LastName',
                         				'label' => 'LastName',
                         				'rules' => 'trim'
                         		),
                         		array(
                         				'field' => 's_Address',
                         				'label' => 'Address',
                         				'rules' => 'trim'
                         		),
                         		array(
                         				'field' => 's_City_ID',
                         				'label' => 'City_ID',
                         				'rules' => 'trim'
                         		),
                         		array(
                         				'field' => 's_Country_ID',
                         				'label' => 'Country_ID',
                         				'rules' => 'trim'
                         		),
                         		array(
                         				'field' => 's_City_Name',
                         				'label' => 'City_Name',
                         				'rules' => 'trim'
                         		),
                         		array(
                         				'field' => 's_Postal_Code',
                         				'label' => 'Postal_Codel',
                         				'rules' => 'trim'
                         		),
                         		array(
                         				'field' => 's_Phone_Number',
                         				'label' => 'Phone_Number',
                         				'rules' => 'trim'		
                         		)
                          	
                        	),
                'customer_shipping' => array(
                				array(
										'field' => 'Cus_ID',
                             			'label' => 'ID',
                                	    'rules' => 'required'
                         			),
                         		array(
										'field' => 'FirstName',
                             			'label' => 'FirstName',
                                	    'rules' => 'trim'
                         			),

                         		array(
                         				'field' => 'LastName',
                         				'label' => 'LastName',
                         				'rules' => 'trim'
                         		),
                         		array(
                         				'field' => 'Address',
                         				'label' => 'Address',
                         				'rules' => 'trim'
                         		),
                         		array(
                         				'field' => 'City_ID',
                         				'label' => 'City_ID',
                         				'rules' => 'trim'
                         		),
                         		array(
                         				'field' => 'Country_ID',
                         				'label' => 'Country_ID',
                         				'rules' => 'trim'
                         		),
                         		array(
                         				'field' => 'City_Name',
                         				'label' => 'City_Name',
                         				'rules' => 'trim'
                         		),
                         		array(
                         				'field' => 'Postal_Code',
                         				'label' => 'Postal_Codel',
                         				'rules' => 'trim'
                         		),
                         		array(
                         				'field' => 'Phone_Number',
                         				'label' => 'Phone_Number',
                         				'rules' => 'trim'		
                         		),
                         		array(
                         				'field' => 'Email',
                         				'label' => 'Email',
                         				'rules' => 'trim'		
                         		),
								array(
										'field' => 'Shipping_ID',
                             			'label' => 'Shipping_ID',
                                	    'rules' => 'trim'
                         			),
                         		array(
										'field' => 's_FirstName',
                             			'label' => 'FirstName',
                                	    'rules' => 'trim'
                         			),

                         		array(
                         				'field' => 's_LastName',
                         				'label' => 'LastName',
                         				'rules' => 'trim'
                         		),
                         		array(
                         				'field' => 's_Address',
                         				'label' => 'Address',
                         				'rules' => 'trim'
                         		),
                         		array(
                         				'field' => 's_City_ID',
                         				'label' => 'City_ID',
                         				'rules' => 'trim'
                         		),
                         		array(
                         				'field' => 's_Country_ID',
                         				'label' => 'Country_ID',
                         				'rules' => 'trim'
                         		),
                         		array(
                         				'field' => 's_City_Name',
                         				'label' => 'City_Name',
                         				'rules' => 'trim'
                         		),
                         		array(
                         				'field' => 's_Postal_Code',
                         				'label' => 'Postal_Codel',
                         				'rules' => 'trim'
                         		),
                         		array(
                         				'field' => 's_Phone_Number',
                         				'label' => 'Phone_Number',
                         				'rules' => 'trim'		
                         		)
                          	
                        	)
						
        	);


/* End of file form_validation.php */
/* Location: ./application/config/form_validation.php */

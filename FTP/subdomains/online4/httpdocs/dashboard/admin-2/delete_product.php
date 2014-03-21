<?php

        // connect to the database
        include_once '../classes/Products.php';
		include_once '../classes/Images.php';
        $proid = $_GET['id'];
		$products = new Products();
		$Images = new Images();
        // confirm that the 'id' variable has been set
        if (isset($_GET['id']))
        {
                // get the 'id' variable from the URL
                $id = $_GET['id'];
                
                // delete record from database
				echo $products->Dbdelete($proid);
                // redirect user after delete is successful
                header("Location: Products.php");
        }
		if (isset($_GET['id']))
		{
		
			$id = $_GET['id'];
			echo $Images->delete($proid);
		
		}
        // if the 'id' variable isn't set, redirect the user
        {
                header("Location: Products.php");
        }

?>
<?php

        // connect to the database
        include_once '../classes/Images.php';
        $imgid = $_GET['id'];
		$images = new Images();
        // confirm that the 'id' variable has been set
        if (isset($_GET['id']) && is_numeric($_GET['id']))
        {
                // get the 'id' variable from the URL
                $id = $_GET['id'];
                
                // delete record from database
				echo $images->Dbdelete($imgid);
                
                // redirect user after delete is successful
                header("Location: Upload.php");
        }
        else
        // if the 'id' variable isn't set, redirect the user
        {
                header("Location: Upload.php");
        }

?>
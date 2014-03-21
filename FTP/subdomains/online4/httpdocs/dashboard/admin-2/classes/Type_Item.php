<?php
include_once("Connection.php");
include_once("ConnectException.php");
class Type_Item
{
	private $Product_ID;
	private $ProductType_ID;
	private $Type_ID;
//Construct
	function __construct()
	{
	}

	function __destruct()
	{
		 $this->Product_ID="";
		 $this->ProductType_ID="";
		 $this->Type_ID="";
	}
//End Construct

//Properties
	public function getProduct_ID()
	{
		return $this->Product_ID;
	}

	public function getProductType_ID()
	{
		return $this->ProductType_ID;
	}

	public function getType_ID()
	{
		return $this->Type_ID;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setProduct_ID($newVal)
	{
		$this->Product_ID = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setProductType_ID($newVal)
	{
		$this->ProductType_ID = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setType_ID($newVal)
	{
		$this->Type_ID = $newVal;
	}
//End Properties

//Operation
	private function bind($ResultSet)
	{
		   if (mysql_num_rows($ResultSet)==0)
		   { 
            throw new Exception('Query not executed.'); 
           }
		   $row=mysql_fetch_array($ResultSet);
           $this->Type_ID=$row['Type_ID'];
		   $this->Product_ID=$row['Product_ID'];
		   $this->ProductType_ID=$row['ProductType_ID'];
	}
	public function selectAll($Type_ID)
	{
	    $strSQL="SELECT  *  FROM type_item WHERE Type_ID=".$Type_ID;
	    $Dbcon= new Connection();
		$code=0;
		try
		{
		  $con = $Dbcon->Dbconnect();
		  $result = $Dbcon->Dbquery($strSQL);
          $this->bind($result);
		  $Dbcon->Dbclose();
		}
		catch(ConnectException $ec)
		{
		    $code=-1;
		}
		catch(Exception $e)
		{
		   $code=-1;
		  try
		  {
		   $Dbcon->Dbclose();
		  }
		  catch(Exception $ex)
		  {
			   
		  }
		}
		return $code;
	}

	public function insertAll($Product_ID,$ProductType_ID)
	{
	    $strSQL  ="INSERT INTO type_item (Product_ID,ProductType_ID) ";
		$strSQL .="VALUES ('".$Product_ID."',".$ProductType_ID.")";
	    $Dbcon= new Connection();
		$code=0;
		try
		{
		  $con = $Dbcon->Dbconnect();
		  mysql_query("BEGIN");
		  $result = $Dbcon->Dbupdate($strSQL);
		  mysql_query("COMMIT");
		  $Dbcon->Dbclose();
		}
		catch(ConnectException $ec)
		{
		    $code=-1;
		}
		catch(Exception $e)
		{
			mysql_query("ROLLBACK");
		    $code=-1;
		    try
			{
				$Dbcon->Dbclose();
			}
			catch(Exception $ex)
			{
			   
			}
		}
		return $code;
	}
	public function Dbdelete($Type_ID)
	{
	    $strSQL="DELETE FROM type_item WHERE Type_ID=".$Type_ID;
	    $Dbcon= new Connection();
		$code=0;
		try
		{
		  $con = $Dbcon->Dbconnect();
		  mysql_query("BEGIN");
		  $result = $Dbcon->Dbupdate($strSQL);
		  mysql_query("COMMIT");
		  $Dbcon->Dbclose();
		}
		catch(ConnectException $ec)
		{
		   $code=-1; 
		}
		catch(Exception $e)
		{
			mysql_query("ROLLBACK");
		    $code=-1;
			try
			{
				$Dbcon->Dbclose();
			}
			catch(Exception $ex)
			{
			   
			}
		}
		return $code;
	}
//End Operation

}
?>
<?php
include_once("Connection.php");
include_once("ConnectException.php");
class Effects
{

	private $Coupon_ID;
	private $EF_ID;
	private $ProductType_ID;
//Construct
	function __construct()
	{
	}

	function __destruct()
	{
	  $this->Coupon_ID="";
	  $this->EF_ID="";
	  $this->ProductType_ID="";
	}
//End Construct


//Properties
	public function getCoupon_ID()
	{
		return $this->Coupon_ID;
	}

	public function getEF_ID()
	{
		return $this->EF_ID;
	}

	public function getProductType_ID()
	{
		return $this->ProductType_ID;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setCoupon_ID($newVal)
	{
		$this->Coupon_ID = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setEF_ID($newVal)
	{
		$this->EF_ID = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setProductType_ID($newVal)
	{
		$this->ProductType_ID = $newVal;
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
           $this->EF_ID=$row['EF_ID'];
		   $this->Coupon_ID=$row['Coupon_ID'];
		   $this->ProductType_ID=$row['ProductType_ID'];
	}
	/**
	 * 
	 * @param Id
	 */
	public function selectAll($EF_ID)
	{
	    $strSQL="SELECT  *  FROM city WHERE EF_ID=".$EF_ID;
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
	public function insertAll($Coupon_ID,$ProductType_ID)
	{
	    $strSQL="INSERT INTO effects (Coupon_ID,ProductType_ID) VALUES ('".$Coupon_ID."',".$ProductType_ID.")";
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
	public function Dbdelete($EF_ID)
	{
	    $strSQL="DELETE FROM effects WHERE EF_ID=".$EF_ID;
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
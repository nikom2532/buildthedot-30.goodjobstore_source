<?php
include_once("Connection.php");
include_once("ConnectException.php");
class Cross_Property
{
	private $Product_ID;
	private $Color_ID;
	private $Property_ID;
	private $Price;
	private $Qty;
	
//Construct
	function __construct()
	{
	}

	function __destruct()
	{
	  $this->Product_ID="";
	  $this->Color_ID="";
	  $this->Property_ID="";
	  $this->Price="";
	  $this->Qty="";
	}
//End Construct

//Properties
	public function getProduct_ID()
	{
		return $this->Product_ID;
	}
	public function getColor_ID()
	{
		return $this->Color_ID;
	}
	public function getProperty_ID()
	{
		return $this->Property_ID;
	}
	public function getPrice()
	{
		return $this->Price;
	}
	public function getQty()
	{
		return $this->Qty;
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
	public function setColor_ID($newVal)
	{
		$this->Color_ID = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setProperty_ID($newVal)
	{
		$this->Property_ID = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setPrice($newVal)
	{
		$this->Price = $newVal;
	}
	public function setQty($newVal)
	{
		$this->Qty = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
//End Properties

//Operation
	private function bind($ResultSet)
	{
		   if (mysql_num_rows($ResultSet)==0)
		   { 
            throw new Exception('Query not executed.'); 
           }
		   $row=mysql_fetch_array($ResultSet);
           $this->Product_ID=$row['Product_ID'];
		   $this->Color_ID=$row['Color_ID'];
		   $this->Property_ID=$row['Property_ID'];
		   $this->Price=$row['Price'];
		   $this->Qty=$row['Qty'];
	}
	public function selectAll($Id)
	{
	    $strSQL="SELECT  *  FROM property WHERE Product_ID=".$Id;
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
	public function insertAll($Product_ID,$Color_ID,$Property_ID,$Price,$Qty)
	{
	    $strSQL="INSERT INTO property (Product_ID,Color_ID,Property_ID,Price,Qty) VALUES ('".$Product_ID."','".$Color_ID."','".$Property_ID."','".$Price."','".$Qty."')";
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
	public function Dbdelete($Id)
	{
	    $strSQL="DELETE FROM property WHERE Product_ID=".$Id;
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
		public function selectid($Product_ID)
	{
	    $strSQL="SELECT * from cross_property where Product_ID = '".$Product_ID."' ";
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
}
<?php
include_once("Connection.php");
include_once("ConnectException.php");
class Cart
{
	private $cart_ID;
	private $Create_Date;
	private $Product_ID;
	private $Qty;
	private $Session_ID;

//Constructor
	function __construct()
	{
	}

	function __destruct()
	{
	  $this->cart_ID="";
	  $this->Create_Date="";
	  $this->Product_ID="";
	  $this->Qty="";
	  $this->Session_ID="";
	}
//End Constructor

//Properties
	public function getcart_ID()
	{
		return $this->cart_ID;
	}

	public function getCreate_Date()
	{
		return $this->Create_Date;
	}

	public function getProduct_ID()
	{
		return $this->Product_ID;
	}

	public function getQty()
	{
		return $this->Qty;
	}

	public function getSession_ID()
	{
		return $this->Session_ID;
	}

	public function setcart_ID($newVal)
	{
		$this->cart_ID = $newVal;
	}

	public function setCreate_Date($newVal)
	{
		$this->Create_Date = $newVal;
	}

	public function setProduct_ID($newVal)
	{
		$this->Product_ID = $newVal;
	}

	public function setQty($newVal)
	{
		$this->Qty = $newVal;
	}

	public function setSession_ID($newVal)
	{
		$this->Session_ID = $newVal;
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
			$this->cart_ID=$row['cart_ID'];
			$this->Create_Date=$row['Create_Date'];
			$this->Product_ID=$row['Product_ID'];
			$this->Qty=$row['Qty'];
			$this->Session_ID=$row['Session_ID'];
	}
	/**
	 * 
	 * @param Id
	 */
	public function selectAll($Id)
	{
	    $strSQL="SELECT  *  FROM cart WHERE cart_ID=".$Id;
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
		    $code= -1;
		}
		catch(Exception $e)
		{
		    $code= -1;
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
	public function insertAll($Product_ID,$Session_ID,$Qty,$Create_Date)
	{
	    $strSQL="INSERT INTO cart (Product_ID,Session_ID,Qty,Create_Date) VALUES ('".$Product_ID."','".$Session_ID."',".$Qty.",'".$Create_Date."')";
		echo $strSQL;
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
		    $code= -1;
		}
		catch(Exception $e)
		{
			mysql_query("ROLLBACK");
		    $code= -1;
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
	public function Dbdelete($cart_ID)
	{
	    $strSQL="DELETE FROM cart WHERE cart_ID=".$cart_ID;
	    $Dbcon= new Connection();
		$code= 0;
		try
		{
		  mysql_query("BEGIN");
		  $con = $Dbcon->Dbconnect();
		  $result = $Dbcon->Dbupdate($strSQL);
		  mysql_query("COMMIT");
		  $Dbcon->Dbclose();
		}
		catch(ConnectException $ec)
		{
		    $code= -1;
		}
		catch(Exception $e)
		{
			mysql_query("ROLLBACK");
		    return -1;
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
	public function insertid($Product_ID)
	{
	    $strSQL="INSERT INTO cart (Product_ID) VALUES ('".$Product_ID."')";
		echo $strSQL;
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
		    $code= -1;
		}
		catch(Exception $e)
		{
			mysql_query("ROLLBACK");
		    $code= -1;
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
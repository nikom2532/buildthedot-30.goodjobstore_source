<?php
include_once("Connection.php");
include_once("ConnectException.php");
class Orders
{
	private $Coupon_ID;
	private $Cus_ID;
	private $Discount_Price;
	private $How_ID;
	private $Order_ID;
	private $Order_Status;
	private $Total_Price;
	private $Total_Weight;
//Construct
	function __construct()
	{
	}

	function __destruct()
	{
		$this->Order_ID="";
		$this->Cus_ID="";
		$this->Coupon_ID="";
		$this->Total_Price="";
		$this->Discount_Price="";
		$this->Order_Status="";
		$this->How_ID="";
		$this->Total_Weight="";
	}
//End Construct

//Properties
	public function getCoupon_ID()
	{
		return $this->Coupon_ID;
	}

	public function getCus_ID()
	{
		return $this->Cus_ID;
	}

	public function getDiscount_Price()
	{
		return $this->Discount_Price;
	}

	public function getHow_ID()
	{
		return $this->How_ID;
	}

	public function getOrder_ID()
	{
		return $this->Order_ID;
	}

	public function getOrder_Status()
	{
		return $this->Order_Status;
	}

	public function getTotal_Price()
	{
		return $this->Total_Price;
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
	public function setCus_ID($newVal)
	{
		$this->Cus_ID = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setDiscount_Price($newVal)
	{
		$this->Discount_Price = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setHow_ID($newVal)
	{
		$this->How_ID = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setOrder_ID($newVal)
	{
		$this->Order_ID = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setOrder_Status($newVal)
	{
		$this->Order_Status = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setTotal_Price($newVal)
	{
		$this->Total_Price = $newVal;
	}
//Properties

//Operation
	private function bind($ResultSet)
	{
			if (mysql_num_rows($ResultSet)==0)
			{ 
				throw new Exception('Query not executed.'); 
			}
			$row=mysql_fetch_array($ResultSet);
			$this->Order_ID=$row['Order_ID'];
			$this->Cus_ID=$row['Cus_ID'];
			$this->Coupon_ID=$row['Coupon_ID'];
			$this->Total_Price=$row['Total_Price'];
			$this->Discount_Price=$row['Discount_Price'];
			$this->Order_Status=$row['Order_Status'];
			$this->How_ID=$row['How_ID'];
			$this->Total_Weight=$row['Total_Weight'];
	}
	/**
	 * 
	 * @param Id
	 */
	public function selectAll($Order_ID)
	{
	    $strSQL="SELECT  *  FROM orders WHERE Order_ID=".$Order_ID;
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

	public function insertAll($Order_ID,$Cus_ID,$Coupon_ID,$Total_Price,$Discount_Price,$Order_Status,$How_ID,$Total_Weight)
	{
	    $strSQL="INSERT INTO orders (Order_ID,Cus_ID,Coupon_ID,Total_Price,Discount_Price,Order_Status,How_ID,Total_Weight) VALUES ('".$Order_ID."','".$Cus_ID."','".$Coupon_ID."',".$Total_Price.",".$Discount_Price.",'".$Order_Status"',".$How_ID.",".$Total_Weight.")";
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
	public function Dbdelete($Order_ID)
	{
	    $strSQL="DELETE FROM orders WHERE Order_ID=".$Order_ID;
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
//End Operation

}
?>
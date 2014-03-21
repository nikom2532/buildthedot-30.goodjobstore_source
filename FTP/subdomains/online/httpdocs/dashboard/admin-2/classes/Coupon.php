<?php
include_once("Connection.php");
include_once("ConnectException.php");
class Coupon
{
	private $Coupon_ID;
	private $Discount_Cash;
	private $Discount_PC;
	private $Discount_Status;
	private $Expired_Date;
	private $Db_Max;
	private $Db_Min;
	private $Start_Date;
//Construct
	function __construct()
	{
	}

	function __destruct()
	{
		 $this->Coupon_ID="";
		 $this->Discount_Cash="";
		 $this->Discount_PC="";
		 $this->Discount_Status="";
		 $this->Expired_Date="";
		 $this->Db_Max="";
		 $this->Db_Min="";
		 $this->Start_Date="";
	}
//End Construct

//Properties
	public function getCoupon_ID()
	{
		return $this->Coupon_ID;
	}

	public function getDiscount_Cash()
	{
		return $this->Discount_Cash;
	}

	public function getDiscount_PC()
	{
		return $this->Discount_PC;
	}

	public function getDiscount_Status()
	{
		return $this->Discount_Status;
	}

	public function getExpired_Date()
	{
		return $this->Expired_Date;
	}

	public function getDb_Max()
	{
		return $this->Db_Max;
	}

	public function getDb_Min()
	{
		return $this->Db_Min;
	}

	public function getStart_Date()
	{
		return $this->Start_Date;
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
	public function setDiscount_Cash($newVal)
	{
		$this->Discount_Cash = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setDiscount_PC($newVal)
	{
		$this->Discount_PC = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setDiscount_Status($newVal)
	{
		$this->Discount_Status = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setExpired_Date($newVal)
	{
		$this->Expired_Date = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setDb_Max($newVal)
	{
		$this->Db_Max = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setDb_Min($newVal)
	{
		$this->Db_Min = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setStart_Date($newVal)
	{
		$this->Start_Date = $newVal;
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
			$this->Coupon_ID=$row['Coupon_ID'];
			$this->Discount_Cash=$row['Discount_Cash'];
			$this->Discount_PC=$row['Discount_PC'];
			$this->Discount_Status=$row['Discount_Status'];
			$this->Expired_Date=$row['Expired_Date'];
			$this->Db_Max=$row['Db_Max'];
			$this->Db_Min=$row['Db_Min'];
			$this->Start_Date=$row['Start_Date'];
	}
	/**
	 * 
	 * @param Id
	 */
	public function selectAll($Coupon_ID)
	{
	    $strSQL="SELECT  *  FROM coupon WHERE Coupon_ID='".$Coupon_ID."'";
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
	public function insertAll($Coupon_ID,$Discount_PC,$Discount_Cash,$Start_Date,$Expired_Date,$Db_Min,$Db_Max,$Discount_Status)
	{
	    $strSQL="INSERT INTO coupon (Coupon_ID,Discount_PC,Discount_Cash,Start_Date,Expired_Date,Db_Min,Db_Max,Discount_Status) VALUES ('".$Coupon_ID."',".$Discount_PC.",".$Discount_Cash.",'".$Start_Date."','".$Expired_Date."',".$Db_Min.",".$Db_Max.",".$Discount_Status.")";
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
	public function Dbdelete($Coupon_ID)
	{
	    $strSQL="DELETE FROM coupon WHERE Coupon_ID='".$Coupon_ID."'";
	    $Dbcon= new Connection();
		$code=0;
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
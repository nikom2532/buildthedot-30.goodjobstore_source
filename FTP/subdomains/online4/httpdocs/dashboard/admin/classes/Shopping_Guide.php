<?php
include_once("Connection.php");
include_once("ConnectException.php");
class Shopping_Guide
{
	private $About_Us_En;
	private $About_Us_Th;
	private $Delivery_En;
	private $Delivery_Th;
	private $Guide_ID;
	private $Payment_Th;
	private $Payment_En;
	private $Return_Chane_En;
	private $Return_Change_Th;
//Construct
	function __construct()
	{
	}

	function __destruct()
	{
		 $this->About_Us_En="";
		 $this->About_Us_Th="";
		 $this->Delivery_En="";
		 $this->Delivery_Th="";
		 $this->Guide_ID="";
		 $this->Payment_Th="";
		 $this->Payment_En="";
		 $this->Return_Chane_En="";
		 $this->Return_Change_Th="";
	}
//End Construct

//Properties
	public function getAbout_Us_En()
	{
		return $this->About_Us_En;
	}

	public function getDelivery_En()
	{
		return $this->Delivery_En;
	}

	public function getDelivery_Th()
	{
		return $this->Delivery_Th;
	}

	public function getGuide_ID()
	{
		return $this->Guide_ID;
	}

	public function getPayment_ Th()
	{
		return $this->Payment_ Th;
	}

	public function getPayment_En()
	{
		return $this->Payment_En;
	}

	public function getReturn_Chane_En()
	{
		return $this->Return_Chane_En;
	}

	public function getReturn_Change_Th()
	{
		return $this->Return_Change_Th;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setAbout_Us_En($newVal)
	{
		$this->About_Us_En = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setDelivery_En($newVal)
	{
		$this->Delivery_En = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setDelivery_Th($newVal)
	{
		$this->Delivery_Th = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setGuide_ID($newVal)
	{
		$this->Guide_ID = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setPayment_ Th($newVal)
	{
		$this->Payment_ Th = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setPayment_En($newVal)
	{
		$this->Payment_En = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setReturn_Chane_En($newVal)
	{
		$this->Return_Chane_En = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setReturn_Change_Th($newVal)
	{
		$this->Return_Change_Th = $newVal;
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
           $this->Guide_ID=$row['Guide_ID'];
		   $this->About_Us_Th=$row['About_Us_Th'];
		   $this->About_Us_En=$row['About_Us_En'];
           $this->Payment_Th=$row['Payment_Th'];
		   $this->Payment_En=$row['Payment_En'];
		   $this->Delivery_Th=$row['Delivery_Th'];
           $this->Delivery_En=$row['Delivery_En'];
		   $this->Return_Change_Th=$row['Return_Change_Th'];
		   $this->Return_Chane_En=$row['Return_Chane_En'];
	}
	public function selectAll($Guide_ID)
	{
	    $strSQL="SELECT  *  FROM shopping_guide WHERE Guide_ID=".$Guide_ID;
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

	public function insertAll($About_Us_Th,$About_Us_En,$Payment_Th,$Payment_En,$Delivery_Th,$Delivery_En,$Return_Change_Th,$Return_Chane_En)
	{
	    $strSQL  ="INSERT INTO shopping_guide (About_Us_Th,About_Us_En,Payment_Th,Payment_En,Delivery_Th";
		$strSQL .=",Delivery_En,Return_Change_Th,Return_Chane_En) ";
		$strSQL .="VALUES ('".$About_Us_Th."','".$About_Us_En."','".$Payment_Th."','".$Payment_En."','";
		$strSQL .=$Delivery_Th."','".$Delivery_En."'.'".$Return_Change_Th."','".$Return_Chane_En."')";
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
	public function Dbdelete($Guide_ID)
	{
	    $strSQL="DELETE FROM shopping_guide WHERE Guide_ID=".$Guide_ID;
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
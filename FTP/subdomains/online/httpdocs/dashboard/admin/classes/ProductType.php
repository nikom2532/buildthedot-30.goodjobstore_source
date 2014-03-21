<?php
include_once("Connection.php");
include_once("ConnectException.php");
class ProductType
{
	private $Max_Price;
	private $Min_Price;
	private $Name_En;
	private $Name_Th;
	private $ProductType_ID;
	private $Step_Price;
//Construct
	function __construct()
	{
	}

	function __destruct()
	{
		 $this->Max_Price="";
		 $this->Min_Price="";
		 $this->Name_En="";
		 $this->Name_Th="";
		 $this->ProductType_ID="";
		 $this->Step_Price="";
	}
//End Construct

//Properties
	public function getMax_Price()
	{
		return $this->Max_Price;
	}

	public function getMin_Price()
	{
		return $this->Min_Price;
	}

	public function getName_En()
	{
		return $this->Name_En;
	}

	public function getProductType_ID()
	{
		return $this->ProductType_ID;
	}

	public function getStep_Price()
	{
		return $this->Step_Price;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setMax_Price($newVal)
	{
		$this->Max_Price = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setMin_Price($newVal)
	{
		$this->Min_Price = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setName_En($newVal)
	{
		$this->Name_En = $newVal;
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
	public function setStep_Price($newVal)
	{
		$this->Step_Price = $newVal;
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
           $this->ProductType_ID=$row['ProductType_ID'];
		   $this->Name_Th=$row['Name_Th'];
		   $this->Name_En=$row['Name_En'];
		   $this->Min_Price=$row['Min_Price'];
		   $this->Max_Price=$row['Max_Price'];
		   $this->Step_Price=$row['Step_Price'];
	}
	public function selectAll($ProductType_ID)
	{
	    $strSQL="SELECT  *  FROM producttype WHERE ProductType_ID=".$ProductType_ID;
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

	public function insertAll($Name_Th,$Name_En,$Min_Price,$Max_Price,$Step_Price)
	{
	    $strSQL  ="INSERT INTO producttype (Name_Th,Name_En,Min_Price,Max_Price,Step_Price) ";
		$strSQL .="VALUES ('".$Name_Th."','".$Name_En."',".Min_Price.",".Max_Price.",".Step_Price.")";
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
	public function Dbdelete($ProductType_ID)
	{
	    $strSQL="DELETE FROM producttype WHERE ProductType_ID=".$ProductType_ID;
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
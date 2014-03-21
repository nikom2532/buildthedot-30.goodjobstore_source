<?php
include_once("Connection.php");
include_once("ConnectException.php");
class Shopping_Option
{
	private $Name_En;
	private $Name_Th;
	private $Option_ID;
	private $Price;
//Construct
	function __construct()
	{
	}

	function __destruct()
	{
		 $this->Name_En="";
		 $this->Name_Th="";
		 $this->Option_ID="";
		 $this->Price="";
	}
//End Construct

//Properties
	public function getName_En()
	{
		return $this->Name_En;
	}

	public function getName_Th()
	{
		return $this->Name_Th;
	}

	public function getOption_ID()
	{
		return $this->Option_ID;
	}

	public function getPrice()
	{
		return $this->Price;
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
	public function setName_Th($newVal)
	{
		$this->Name_Th = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setOption_ID($newVal)
	{
		$this->Option_ID = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setPrice($newVal)
	{
		$this->Price = $newVal;
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
           $this->Option_ID=$row['Option_ID'];
		   $this->Name_Th=$row['Name_Th'];
		   $this->Name_En=$row['Name_En'];
		   $this->Price=$row['Price'];
	}
	public function selectAll($Option_ID)
	{
	    $strSQL="SELECT  *  FROM shopping_option WHERE Option_ID=".$Option_ID;
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

	public function insertAll($Name_Th,$Name_En,$Price)
	{
	    $strSQL  ="INSERT INTO shopping_option (Name_Th,Name_En,Price) ";
		$strSQL .="VALUES ('".$Name_Th."','".$Name_En."',".$Price.")";
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
	public function Dbdelete($Option_ID)
	{
	    $strSQL="DELETE FROM shopping_option WHERE Option_ID=".$Option_ID;
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
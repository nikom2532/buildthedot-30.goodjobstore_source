<?php
include_once("Connection.php");
include_once("ConnectException.php");
class How_Delivery
{

	private $How_ID;
	private $Name_Th;
	private $Name_En;
//Construct
	function __construct()
	{
	}

	function __destruct()
	{
	  $this->How_ID="";
	  $this->Name_Th="";
	  $this->Name_En="";
	}
//End Construct

//Properties
	public function getHow_ID()
	{
		return $this->How_ID;
	}

	public function getName_En()
	{
		return $this->Name_En;
	}

	public function getName_Th()
	{
		return $this->Name_Th;
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
//End Properties

//Operation
	private function bind($ResultSet)
	{
		   if (mysql_num_rows($ResultSet)==0)
		   { 
            throw new Exception('Query not executed.'); 
           }
		   $row=mysql_fetch_array($ResultSet);
           $this->How_ID=$row['How_ID'];
		   $this->Name_Th=$row['Name_Th'];
		   $this->Name_En=$row['Name_En'];
	}
	public function selectAll($How_ID)
	{
	    $strSQL="SELECT  *  FROM how_delivery WHERE How_ID=".$How_ID;
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

	public function insertAll($Name_Th,$Name_En)
	{
	    $strSQL="INSERT INTO how_delivery (Name_Th,Name_En) VALUES ('".$Name_Th."','".$Name_En."')";
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
	public function Dbdelete($How_ID)
	{
	    $strSQL="DELETE FROM how_delivery WHERE How_ID=".$How_ID;
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
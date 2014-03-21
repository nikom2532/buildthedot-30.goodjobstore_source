<?php
include_once("Connection.php");
include_once("ConnectException.php");
class Group
{
	private $Group_ID;
	private $Name;
//Construct
	function __construct()
	{
	}

	function __destruct()
	{
	  $this->Group_ID="";
	  $this->Name="";
	}
//End Construct

//Properties
	public function getGroup_ID()
	{
		return $this->Group_ID;
	}

	public function getName()
	{
		return $this->Name;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setGroup_ID($newVal)
	{
		$this->Group_ID = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setName($newVal)
	{
		$this->Name = $newVal;
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
           $this->Group_ID=$row['Group_ID'];
		   $this->Name=$row['Name'];
	}
	public function selectAll($Group_ID)
	{
	    $strSQL="SELECT  *  FROM groups WHERE Group_ID=".$Group_ID;
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

	public function insertAll($Name)
	{
	    $strSQL="INSERT INTO groups (Name) VALUES ('".$Name."')";
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
	public function Dbdelete($Group_ID)
	{
	    $strSQL="DELETE FROM groups WHERE Group_ID=".$Group_ID;
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
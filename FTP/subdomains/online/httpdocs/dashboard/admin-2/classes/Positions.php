<?php
include_once("Connection.php");
include_once("ConnectException.php");
class Positions
{
	private $Permission_ID;
	private $Position_ID;
	private $Position_name;
//Construct
	function __construct()
	{
	}

	function __destruct()
	{
		 $this->Permission_ID="";
		 $this->Position_ID="";
		 $this->Position_name="";
	}
//End Construct

//Properties
	public function getPermission_ID()
	{
		return $this->Permission_ID;
	}

	public function getPosition_ID()
	{
		return $this->Position_ID;
	}

	public function getPosition_name()
	{
		return $this->Position_name;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setPermission_ID($newVal)
	{
		$this->Permission_ID = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setPosition_ID($newVal)
	{
		$this->Position_ID = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setPosition_name($newVal)
	{
		$this->Position_name = $newVal;
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
           $this->Position_ID=$row['Position_ID'];
		   $this->Position_name=$row['Position_name'];
		   $this->Permission_ID=$row['Permission_ID'];
	}
	public function selectAll($Position_ID)
	{
	    $strSQL="SELECT  *  FROM positions WHERE Position_ID=".$Position_ID;
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

	public function insertAll($Position_name,$Permission_ID)
	{
	    $strSQL="INSERT INTO positions (Position_name,Permission_ID) VALUES ('".$Position_name."',".$Permission_ID.")";
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
	public function Dbdelete($Position_ID)
	{
	    $strSQL="DELETE FROM positions WHERE Position_ID=".$Position_ID;
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
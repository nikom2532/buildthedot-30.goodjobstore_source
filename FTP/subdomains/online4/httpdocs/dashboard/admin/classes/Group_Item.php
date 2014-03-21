<?php
include_once("Connection.php");
include_once("ConnectException.php");
class Group_Item
{

	private $Cus_ID;
	private $Group_ID;
	private $Group_Item_ID;
//Construct
	function __construct()
	{
	}

	function __destruct()
	{
	  $this->Cus_ID="";
	  $this->Group_ID="";
	  $this->Group_Item_ID="";
	}
//End Construct

//Properties
	public function getCus_ID()
	{
		return $this->Cus_ID;
	}

	public function getGroup_ID()
	{
		return $this->Group_ID;
	}

	public function getGroup_Item_ID()
	{
		return $this->Group_Item_ID;
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
	public function setGroup_ID($newVal)
	{
		$this->Group_ID = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setGroup_Item_ID($newVal)
	{
		$this->Group_Item_ID = $newVal;
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
           $this->Group_Item_ID=$row['Group_Item_ID'];
		   $this->Group_ID=$row['Group_ID'];
		   $this->Cus_ID=$row['Cus_ID'];
	}
	public function selectAll($Group_Item_ID)
	{
	    $strSQL="SELECT  *  FROM group_item WHERE Group_Item_ID=".$Group_Item_ID;
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
	public function insertAll($Group_ID,$Cus_ID)
	{
	    $strSQL="INSERT INTO group_item (Group_ID,Cus_ID) VALUES (".$Group_ID.",'".$Cus_ID."')";
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
	public function Dbdelete($Group_Item_ID)
	{
	    $strSQL="DELETE FROM group_item WHERE Group_Item_ID=".$Group_Item_ID;
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
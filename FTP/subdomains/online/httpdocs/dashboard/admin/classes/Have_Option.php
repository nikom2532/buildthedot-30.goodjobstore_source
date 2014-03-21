<?php
include_once("Connection.php");
include_once("ConnectException.php");
class Have_Option
{
	private $Have_ID;
	private $Order_ID;
	private $Option_ID;
//Construct
	function __construct()
	{
	}

	function __destruct()
	{
	  $this->Have_ID="";
	  $this->Order_ID="";
	  $this->Option_ID="";
	}
//End Construct

//Propeerties
	public function getHave_ID()
	{
		return $this->Have_ID;
	}

	public function getOption_ID()
	{
		return $this->Option_ID;
	}

	public function getOrder_ID()
	{
		return $this->Order_ID;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setHave_ID($newVal)
	{
		$this->Have_ID = $newVal;
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
	public function setOrder_ID($newVal)
	{
		$this->Order_ID = $newVal;
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
           $this->Have_ID=$row['Have_ID'];
		   $this->Order_ID=$row['Order_ID'];
		   $this->Option_ID=$row['Option_ID'];
	}
	public function selectAll($Have_ID)
	{
	    $strSQL="SELECT  *  FROM have_option WHERE Have_ID=".$Have_ID;
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

	public function insertAll($Order_ID,$Option_ID)
	{
	    $strSQL="INSERT INTO have_option (Order_ID,Option_ID) VALUES ('".$Order_ID."',".$Option_ID.")";
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
	public function Dbdelete($Have_ID)
	{
	    $strSQL="DELETE FROM have_option WHERE Have_ID=".$Have_ID;
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
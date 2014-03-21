<?php
include_once("Connection.php");
include_once("ConnectException.php");
class Cross_Color
{

	private $Cross_Color_ID;
	private $Color_ID;
	private $Product_ID;
	
//Construct
	function __construct()
	{
	}

	function __destruct()
	{
	  $this->Cross_Color_ID="";
	  $this->Color_ID="";
	  $this->Product_ID="";
	}
//End Construct

//Properties
	public function getCross_Color_ID()
	{
		return $this->Cross_Color_ID;
	}

	public function getColor_ID()
	{
		return $this->Color_ID;
	}

	public function getProduct_ID()
	{
		return $this->Product_ID;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setCross_Color_ID($newVal)
	{
		$this->Cross_Color_ID = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setColor_ID($newVal)
	{
		$this->Color_ID = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setProduct_ID($newVal)
	{
		$this->Product_ID = $newVal;
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
           $this->Cross_Color_ID=$row['Cross_Color_ID'];
		   $this->Color_ID=$row['Color_ID'];
		   $this->Product_ID=$row['Product_ID'];
	}
	public function selectAll($Id)
	{
	    $strSQL="SELECT  *  FROM Cross_Color WHERE Cross_Color_ID=".$Id;
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
	public function insertAll($Color_ID,$Product_ID)
	{
	    $strSQL="INSERT INTO Cross_Color (Name_TH,Name_EN) VALUES ('".$Name_TH."','".$Name_EN."')";
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
	public function Dbdelete($Id)
	{
	    $strSQL="DELETE FROM Cross_Color WHERE Cross_Color_ID=".$Id;
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
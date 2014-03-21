<?php
include_once("Connection.php");
include_once("ConnectException.php");
class City
{
	private $City_ID;
	private $Name_En;
	private $Name_Th;

//Properties
	public function getCity_ID()
	{
		return $this->City_ID;
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
	public function setCity_ID($newVal)
	{
		$this->City_ID = $newVal;
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
           $this->City_ID=$row['City_ID'];
		   $this->Name_En=$row['Name_En'];
		   $this->Name_Th=$row['Name_Th'];
	}
	/**
	 * 
	 * @param Id
	 */
	public function selectAll($Id)
	{
	    $strSQL="SELECT  *  FROM city WHERE City_ID=$Id";
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
	public function insertAll($Th,$En)
	{
	    $strSQL="INSERT INTO city (Name_Th,Name_En) VALUES ('".$Th."','".$En."')";
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
	    $strSQL="DELETE FROM city WHERE City_ID=".$Id;
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
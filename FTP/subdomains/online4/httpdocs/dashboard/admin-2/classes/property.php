<?php
include_once("Connection.php");
include_once("ConnectException.php");
class Property
{

	private $Property_ID;
	private $Name_TH;
	private $Name_EN;
	private $property;
	
//Construct
	function __construct()
	{
	}

	function __destruct()
	{
	  $this->Property_ID="";
	  $this->Name_TH="";
	  $this->Name_EN="";
	  $this->property="";
	}
//End Construct

//Properties
	public function getproperty()
	{
		return $this->property;
	}
	public function getProperty_ID()
	{
		return $this->Property_ID;
	}

	public function getName_TH()
	{
		return $this->Name_TH;
	}

	public function getName_EN()
	{
		return $this->Name_EN;
	}
	
	/**
	 * 
	 * @param newVal
	 */
	public function setproperty($newVal)
	{
		$this->property = $newVal;
	}
	/**
	 * 
	 * @param newVal
	 */
	public function setProperty_ID($newVal)
	{
		$this->Property_ID = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setName_TH($newVal)
	{
		$this->Name_TH = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setName_EN($newVal)
	{
		$this->Name_EN = $newVal;
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
           $this->$Property_ID=$row['Property_ID'];
		   $this->Name_TH=$row['Name_TH'];
		   $this->Name_EN=$row['Name_EN'];
	}
	public function selectAll($Id)
	{
	    $strSQL="SELECT  *  FROM property WHERE Property_ID=".$Id;
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
	public function insertAll($Name_TH,$Name_EN)
	{
	    $strSQL="INSERT INTO property (Name_TH,Name_EN) VALUES ('".$Name_TH."','".$Name_EN."')";
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
	    $strSQL="DELETE FROM property WHERE Property_ID=".$Id;
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
	
	//select property
	
	public function selectproperty()
	{
	    $strSQL="SELECT  *  FROM property";
	    $Dbcon= new Connection();
		$code=0;
		try
		{
		  $con = $Dbcon->Dbconnect();
		  $result = $Dbcon->Dbquery($strSQL);
          $this->bindproperty($result);
		  $Dbcon->Dbclose();
		}
		catch(ConnectException $ec)
		{
		    $code= -1;
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
	private function bindproperty($ResultSet)
	{
			if (mysql_num_rows($ResultSet)==0)
			{ 
				throw new Exception('Query not executed.'); 
			}
			$dataset= null;
			while($row=mysql_fetch_array($ResultSet))
			{
			$dataset .= "<option value='".$row['Property_ID']."'>".$row['Name_En']."</option>";
		
			}
				$this->setproperty($dataset);
	}
	
	public function insert_crossproperty($Property_ID,$Product_ID,$Color_ID,$Price,$Qty)
	{
	    $strSQL="INSERT INTO cross_property(Property_ID,Product_ID,Color_ID,Price,Qty) VALUES ('".$Property_ID."','".$Product_ID."','".$Color_ID."','".$Price."','".$Qty."')";
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

}

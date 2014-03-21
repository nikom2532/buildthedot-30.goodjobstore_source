<?php
include_once("Connection.php");
include_once("ConnectException.php");
class Color
{

	private $Color_ID;
	private $Name_TH;
	private $Name_EN;
	private $color;
	
//Construct
	function __construct()
	{
	}

	function __destruct()
	{
	  $this->Color_ID="";
	  $this->Name_TH="";
	  $this->Name_EN="";
	  $this->color="";
	}
//End Construct

//Properties
	public function getcolor()
	{
		return $this->color;
	}
	public function getColor_ID()
	{
		return $this->Color_ID;
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
	public function setcolor($newVal)
	{
		$this->color = $newVal;
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
           $this->Color_ID=$row['Color_ID'];
		   $this->Name_TH=$row['Name_TH'];
		   $this->Name_EN=$row['Name_EN'];
	}
	public function selectAll($Id)
	{
	    $strSQL="SELECT  *  FROM Color WHERE Color_ID=".$Id;
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
	    $strSQL="INSERT INTO color (Name_TH,Name_EN) VALUES ('".$Name_TH."','".$Name_EN."')";
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
	    $strSQL="DELETE FROM Color WHERE Color_ID=".$Id;
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
	
	//select color
	
	public function selectcolor()
	{
	    $strSQL="SELECT  *  FROM color";
	    $Dbcon= new Connection();
		$code=0;
		try
		{
		  $con = $Dbcon->Dbconnect();
		  $result = $Dbcon->Dbquery($strSQL);
          $this->bindcolor($result);
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
	private function bindcolor($ResultSet)
	{
			if (mysql_num_rows($ResultSet)==0)
			{ 
				throw new Exception('Query not executed.'); 
			}
			$dataset= null;
			while($row=mysql_fetch_array($ResultSet))
			{
			$dataset .= "<option value='".$row['Color_ID']."'>".$row['Name_EN']."</option>";
		
			}
				$this->setcolor($dataset);
	}
	
	public function insert_crosscolor($Color_ID,$Product_ID)
	{
	    $strSQL="INSERT INTO cross_color(Color_ID,Product_ID) VALUES ('".$Color_ID."','".$Product_ID."')";
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

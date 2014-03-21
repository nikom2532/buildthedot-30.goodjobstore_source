<?php
include_once("Connection.php");
include_once("ConnectException.php");
class Questions
{
	private $Answer;
	private $Email;
	private $Product_ID;
	private $Question;
	private $Question_ID;
//Construct
	function __construct()
	{
	}

	function __destruct()
	{
		 $this->Answer="";
		 $this->Email="";
		 $this->Product_ID="";
		 $this->Question="";
		 $this->Question_ID="";
	}
//End Construct

//Properties
	public function getAnswer()
	{
		return $this->Answer;
	}

	public function getEmail()
	{
		return $this->Email;
	}

	public function getProduct_ID()
	{
		return $this->Product_ID;
	}

	public function getQuestion()
	{
		return $this->Question;
	}

	public function getQuestion_ID()
	{
		return $this->Question_ID;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setAnswer($newVal)
	{
		$this->Answer = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setEmail($newVal)
	{
		$this->Email = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setProduct_ID($newVal)
	{
		$this->Product_ID = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setQuestion($newVal)
	{
		$this->Question = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setQuestion_ID($newVal)
	{
		$this->Question_ID = $newVal;
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
           $this->Question_ID=$row['Question_ID'];
		   $this->Product_ID=$row['Product_ID'];
		   $this->Email=$row['Email'];
		   $this->Question=$row['Question'];
		   $this->Answer=$row['Answer'];
	}
	public function selectAll($Question_ID)
	{
	    $strSQL="SELECT  *  FROM questions WHERE Question_ID=".$Question_ID;
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

	public function insertAll($Product_ID,$Email,$Question,$Answer)
	{
	    $strSQL  ="INSERT INTO questions (Product_ID,Email,Question,Answer) ";
		$strSQL .="VALUES ('".$Product_ID."','".$Email."','".$Question."','".$Answer."')";
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
	public function Dbdelete($Question_ID)
	{
	    $strSQL="DELETE FROM questions WHERE Question_ID=".$Question_ID;
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
<?php
include_once("Connection.php");
include_once("ConnectException.php");
class Range_Weight
{
	private $How_ID;
	private $Price;
	private $Range_ID;
	private $Size;
	private $Weight_End;
	private $Weight_Start;
//Construct
	function __construct()
	{
	}

	function __destruct()
	{
		 $this->How_ID="";
		 $this->Price="";
		 $this->Range_ID="";
		 $this->Size="";
		 $this->Weight_End="";
		 $this->Weight_Start="";
	}
//End Construct

//Properties
	public function getHow_ID()
	{
		return $this->How_ID;
	}

	public function getPrice()
	{
		return $this->Price;
	}

	public function getRange_ID()
	{
		return $this->Range_ID;
	}

	public function getSize()
	{
		return $this->Size;
	}

	public function getWeight_End()
	{
		return $this->Weight_End;
	}

	public function getWeight_Start()
	{
		return $this->Weight_Start;
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
	public function setPrice($newVal)
	{
		$this->Price = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setRange_ID($newVal)
	{
		$this->Range_ID = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setSize($newVal)
	{
		$this->Size = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setWeight_End($newVal)
	{
		$this->Weight_End = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setWeight_Start($newVal)
	{
		$this->Weight_Start = $newVal;
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
           $this->Range_ID=$row['Range_ID'];
		   $this->How_ID=$row['How_ID'];
		   $this->Weight_Start=$row['Weight_Start'];
		   $this->Weight_End=$row['Weight_End'];
		   $this->Size=$row['Size'];
		   $this->Price=$row['Price'];
	}
	public function selectAll($Range_ID)
	{
	    $strSQL="SELECT  *  FROM range_weight WHERE Range_ID=".$Range_ID;
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

	public function insertAll($How_ID,$Weight_Start,$Weight_End,$Size,$Price)
	{
	    $strSQL  ="INSERT INTO range_weight (How_ID,Weight_Start,Weight_End,Size,Price) ";
		$strSQL .="VALUES (".$How_ID.",".$Weight_Start.",".$Weight_End.",'".$Size."',".$Price.")";
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
	public function Dbdelete($Range_ID)
	{
	    $strSQL="DELETE FROM range_weight WHERE Range_ID=".$Range_ID;
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